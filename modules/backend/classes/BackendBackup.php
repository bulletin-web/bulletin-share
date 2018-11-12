<?php namespace Backend\Classes;
use Illuminate\Support\Facades\File as File;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Backend\Models\BackendBackup as ModelBackendBackup;
use Validator;
use October\Rain\Support\Facades\Config;
use Backend\Facades\BackendAuth;
/**
 * Class BackendBackup
 * @package Backend\Classes
 */
class BackendBackup
{
    public $rules = [
        'storage_path' => 'required|between:1,255',
        'schedule_option' => 'required',
        'schedule_time_1' => 'numeric|min:0|max:23',
        'schedule_time_2' => 'numeric|min:0|max:23',
        'schedule_day' => 'required_if:schedule_option,==,2'
    ];

    public $message = [
        'storage_path.required' => 'ファイルの保存場所は、必ず指定してください。',
        'storage_path.between' => 'ファイルの保存場所は、1文字から 255文字にしてください。',
        'schedule_option.required' => 'スケジュールは、必ず指定してください。',
        'schedule_time_1.numeric' => '時には、数字を指定してください。',
        'schedule_time_1.min' => '時には、0以上の数字を指定してください。',
        'schedule_time_1.max' => '時には、23以下の数字を指定してください。',
        'schedule_time_2.numeric' => '時には、数字を指定してください。',
        'schedule_time_2.min' => '時には、0以上の数字を指定してください。',
        'schedule_time_2.max' => '時には、23以下の数字を指定してください。',
        'schedule_day.required_if' => 'スケジュールが週１回の場合、曜日を指定してください。'
    ];

    public function dumpSql()
    {
        $DBUSER = Config::get('database.connections.'.Config::get('database.default').'.username');
        $DBPASSWD = Config::get('database.connections.'.Config::get('database.default').'.password');
        $DBHOST = Config::get('database.connections.'.Config::get('database.default').'.host');
        $DBPORT = Config::get('database.connections.'.Config::get('database.default').'.port');
        $DATABASE = Config::get('database.connections.'.Config::get('database.default').'.database');

        $pathStoreBackup = storage_path('app/backup'); //default folder save file backup

        $setting = $this->getData();

        if ($setting) {
            $pathStoreBackup = storage_path("$setting->storage_path");
        }

        if(!is_dir($pathStoreBackup)) {
            mkdir($pathStoreBackup, 0755);
        }

        $fileName = $pathStoreBackup . '/' . date('Ymdhis') .'.sql';


        $command = "mysqldump --user=" . $DBUSER ." --password=" . $DBPASSWD . " --host=" . $DBHOST . " --port=" . $DBPORT . " " . $DATABASE . "  > " . $fileName;

        exec($command, $output, $returnVar);

        if ($returnVar == 0) {
            return $fileName;
        }

        return false;
    }

    public function downloadFile($file)
    {
        if (file_exists($file))
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    /**
     * backup media function
     */
    public function backupMedia()
    {
        $path = storage_path('app/media'); // folder store media and upload system

        $pathStoreBackup = storage_path('app/backup'); //default folder save file backup

        $setting = $this->getData();

        if ($setting) {
            $pathStoreBackup = storage_path("$setting->storage_path");
        }

        if(!is_dir($pathStoreBackup)) {
            mkdir($pathStoreBackup, 0755);
        }

        $fileName = sprintf('%s.zip', $pathStoreBackup . '/' . date('Ymdhis'));

        $zip = new ZipArchive;
        $zip->open($fileName, ZipArchive::CREATE);

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (! $file->isDir()) {
                $filePath = $file->getRealPath();

                $relativePath = substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return $fileName;
    }

    /**
     * Function validate value
     *
     * @param $data
     * @return mixed
     */
    public function validation($data)
    {

        return Validator::make($data, $this->rules, $this->message);
    }

    /**
     * function store setting backup
     *
     * @param $data
     * @return bool
     */
    public function store($data)
    {
        $record = ModelBackendBackup::first();

        if (!$record) {
            $record = new ModelBackendBackup();
        }

        $record->storage_path = $data['storage_path'];
        $record->schedule_option = $data['schedule_option'];
        $record->user_created_id = isset($record->user_created_id) ? $record->user_created_id : BackendAuth::getUser()->id;
        $record->user_updated_id = BackendAuth::getUser()->id;

        if ($data['schedule_option'] == 1) {
            $record->schedule_time_1 = $data['schedule_time_1'] ?: null;
            $record->schedule_day = null;
            $record->schedule_time_2 = null;
        } elseif ($data['schedule_option'] == 2) {
            $record->schedule_time_1 = null;
            $record->schedule_day = is_numeric($data['schedule_day']) ? $data['schedule_day'] : null;
            $record->schedule_time_2 = $data['schedule_time_2'] ?: null;
        }

        if($record->save())
        {
            return true;
        }

        return false;
    }

    public function getData()
    {
        $record = ModelBackendBackup::first();

        if ($record) {
            return $record;
        }

        return null;
    }

    public function uploadFileRestore($file)
    {
        $fileName = $file->getClientOriginalName();

        if ($file->move(storage_path(), $fileName)) {
            return $fileName;
        }

        return false;
    }

    public function importSql($file)
    {
        $DBUSER = Config::get('database.connections.'.Config::get('database.default').'.username');
        $DBPASSWD = Config::get('database.connections.'.Config::get('database.default').'.password');
        $DBHOST = Config::get('database.connections.'.Config::get('database.default').'.host');
        $DATABASE = Config::get('database.connections.'.Config::get('database.default').'.database');

        $fileName = $this->uploadFileRestore($file);

        if ($fileName) {
            $command = "mysql --user=" . $DBUSER ." --password=" . $DBPASSWD . " --host=" . $DBHOST . " " . $DATABASE . "  < " . storage_path($fileName);

            exec($command, $output, $returnVar);

            if ($returnVar == 0) {
                if (File::exists(storage_path($fileName))) {
                    unlink(storage_path($fileName));
                }

                return true;
            }
        }
        return false;
    }
}
