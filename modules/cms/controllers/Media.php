<?php namespace Cms\Controllers;

use Backend\Facades\Backend;
use BackendMenu;
use Backend\Classes\Controller;
use Cms\Widgets\MediaManager;
use Illuminate\Support\Facades\Response;
use October\Rain\Support\Facades\Flash;
use StdClass;

/**
 * CMS Media Manager
 *
 * @package october\cms
 * @author Alexey Bobkov, Samuel Georges
 */
class Media extends Controller
{
    /**
     * @var array Permissions required to view this page.
     */
    public $requiredPermissions = ['backend.blog*'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.Cms', 'media', true);
        $this->pageTitle = 'cms::lang.media.menu_label';

        $manager = new MediaManager($this, 'manager');
        $manager->bindToController();
    }

    /**
     *
     */
    public function index()
    {
        $this->bodyClass = 'compact-container';
        $this->addCss(Backend::skinAsset('assets/css/croppie/croppie.css'));
        $this->addJs(Backend::skinAsset('assets/js/croppie/croppie.js'));
        $this->addJs(Backend::skinAsset('assets/js/croppie/croppie-custom.js'));
    }

    /**
     * @return mixed
     */
    public function resizeImg()
    {
        if (post()) {
            $data = post('imagebase64');
            $fileName = post('fileName');
            $path = ltrim(post('path'), '/');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $upload = file_put_contents($path . time(). '_' . $fileName, $data);
            if ($upload) {
                Flash::success('新しい画像が作成されていました。');
                return Response::json(['success' => 'success']);
            } else {
                Flash::error('Error');
                return Response::json(['error' => 'error']);
            }
        }
        return Backend::redirect('cms/media');
    }

    /**
     * @return mixed
     */
    public function uploadImg()
    {
        if ($_FILES) {
            // Allowed extentions.
            $allowedExts = array("gif", "jpeg", "jpg", "png", "blob");

            // Get filename.
            $temp = explode(".", $_FILES["file"]["name"]);

            // Get extension.
            $extension = end($temp);

            // An image check is being done in the editor but it is best to
            // check that again on the server side.
            // Do not use $_FILES["file"]["type"] as it can be easily forged.
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

            if ((($mime == "image/gif")
                    || ($mime == "image/jpeg")
                    || ($mime == "image/pjpeg")
                    || ($mime == "image/x-png")
                    || ($mime == "image/png"))
                && in_array(strtolower($extension), $allowedExts)) {
                // Generate new random name.
                $name = time(). '_'. $_FILES["file"]["name"];

                // Save file in the uploads folder.
                $upload = move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/storage/app/media/" . $name);

                if ($upload) {
                    // Generate response.
                    $response = new StdClass;
                    $response->link = "/storage/app/media/" . $name;
                    return Response::json($response);
                } else {
                    return Response::json(['error' => 'error']);
                }
            }
        } else {
            return Backend::redirect('cms/media');
        }
    }

    /**
     * @return mixed
     */
    public function uploadVideo()
    {
        if ($_FILES) {
            // Allowed extentions.
            $allowedExts = array("mp4", "webm", "ogg");

            // Get filename.
            $temp = explode(".", $_FILES["file"]["name"]);

            // Get extension.
            $extension = end($temp);

            // An image check is being done in the editor but it is best to
            // check that again on the server side.
            // Do not use $_FILES["file"]["type"] as it can be easily forged.
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

            if ((($mime == "video/mp4")
                    || ($mime == "video/webm")
                    || ($mime == "video/ogg"))
                && in_array(strtolower($extension), $allowedExts)) {
                // Generate new random name.
                $name = time(). '_'. $_FILES["file"]["name"];

                // Save file in the uploads folder.
                $upload = move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/storage/app/media/" . $name);

                if ($upload) {
                    // Generate response.
                    $response = new StdClass;
                    $response->link = "/storage/app/media/" . $name;
                    return Response::json($response);
                } else {
                    return Response::json(['error' => 'error']);
                }
            }
        } else {
            return Backend::redirect('cms/media');
        }
    }
}
