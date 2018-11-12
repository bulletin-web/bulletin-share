<?php

return [
    'app' => [
        'name' => 'October CMS',
        'tagline' => '基本に戻ろう！',
    ],
    'directory' => [
        'create_fail' => "ディレクトリ':name'を作成できません。",
    ],
    'file' => [
        'create_fail' => "ファイル':name'を作成できません。",
    ],
    'combiner' => [
        'not_found' => "コンバイナファイル':name'が見つかりません。",
    ],
    'system' => [
        'name' => 'システム',
        'menu_label' => 'システム',
        'categories' => [
            'cms' => 'CMS',
            'misc' => 'その他',
            'logs' => 'ログ',
            'mail' => 'メール配信管理',
            'shop' => 'ショップ',
            'team' => 'チーム',
            'users' => 'ユーザー',
            'system' => 'システム',
            'social' => 'ソーシャル',
            'events' => 'イベント',
            'customers' => 'カスタマー',
            'my_settings' => 'マイ設定',
            'administrators' => 'ユーザー管理',
            'website' => 'サイト管理',
            'todos' => 'ワークフロー管理',
            'contents' => 'コンテンツ管理',
            'comments' => 'コメント管理',
            'plugin_manager' => 'プラグイン管理'
        ]
    ],
    'plugin' => [
        'unnamed' => '名前なしプラグイン',
        'name' => [
            'label' => 'プラグイン名',
            'help' => '重複しないプラグイン名を付けてください。（例：RainLab.Blog）',
        ],
    ],
    'plugins' => [
        'manage' => 'プラグイン管理',
        'enable_or_disable' => '有効化・無効化',
        'enable_or_disable_title' => 'プラグインの有効化・無効化',
        'remove' => '削除',
        'refresh' => '更新',
        'disabled_label' => '無効にする',
        'disabled_help' => 'プラグインを無効にすると、アプリケーションから参照されなくなります。',
        'selected_amount' => 'プラグインを:amount個選択',
        'remove_confirm' => '削除していいですか？',
        'remove_success' => 'システムからプラグインを削除しました。',
        'refresh_confirm' => '更新していいですか？',
        'refresh_success' => 'システム内のプラグインを更新しました。',
        'disable_confirm' => '無効にしていいですか？',
        'disable_success' => 'プラグインを無効にしました。',
        'enable_success' => 'プラグインを有効にしました。',
        'unknown_plugin' => 'システムから見知らぬプラグインを削除しました。'
    ],
    'project' => [
        'name' => 'プロジェクト',
        'owner_label' => '所有者',
        'attach' => 'プロジェクト追加',
        'detach' => 'プロジェクト切り離し',
        'none' => '無し',
        'id' => [
            'label' => 'プロジェクトID',
            'help' => 'プロジェクトIDの見つけ方',
            'missing' => '使用するプロジェクトのIDを指定してください。',
        ],
        'detach_confirm' => 'このプロジェクトを切り離しますか？',
        'unbind_success' => 'プロジェクトを切り離しました。',
    ],
    'settings' => [
        'menu_label' => '設定',
        'not_found' => '指定された設定は使えません。',
        'missing_model' => 'モデルの定義が見つかりません。',
        'update_success' => ':name を設定しました。',
        'return' => 'システム設定へ戻る',
        'search' => '検索'
    ],
    'mail' => [
        'log_file' => 'ログファイル',
        'menu_label' => 'メール配信設定',
        'menu_description' => 'メール設定の管理',
        'general' => 'メール配信管理',
        'method' => 'メール方法',
        'sender_name' => '送信者名',
        'sender_email' => '送信者メール',
        'php_mail' => 'PHPメール',
        'smtp' => 'SMTP',
        'smtp_address' => 'SMTPアドレス',
        'smtp_authorization' => 'SMTP認証が必要',
        'smtp_authorization_comment' => 'SMTPサーバーの認証が必要な場合、チェックしてください。',
        'smtp_username' => 'ユーザー名',
        'smtp_password' => 'パスワード',
        'smtp_port' => 'SMTPポート',
        'smtp_ssl' => 'SSL接続が必要',
        'sendmail' => 'Sendmail',
        'sendmail_path' => 'Sendmailパス',
        'sendmail_path_comment' => 'Sendmailプログラムへのパスを指定してください。',
        'mailgun' => 'Mailgun',
        'mailgun_domain' => 'Mailgunドメイン',
        'mailgun_domain_comment' => 'Mailgunドメイン名を指定してください。',
        'mailgun_secret' => 'Mailgun APIキー',
        'mailgun_secret_comment' => 'Mailgun APIキーを指定してください。'
    ],
    'mail_templates' => [
        'menu_label' => 'メール配信先設定',
        'menu_description' => 'メールテンプレートの変更、ユーザー・アドミニストレーターへの送信、メールレイアウトの管理。',
        'new_template' => '新規テンプレート',
        'new_layout' => '新規レイアウト',
        'template' => 'テンプレート',
        'templates' => 'テンプレートs',
        'menu_layouts_label' => 'メールレイアウト',
        'layout' => 'レイアウト',
        'layouts' => 'レイアウトs',
        'name' => '名前',
        'name_comment' => 'システム内で一意な名前をつけてください。',
        'code' => 'コード',
        'code_comment' => 'システム内で一意なコードをつけてください。',
        'subject' => 'サブジェクト',
        'subject_comment' => 'Emailメッセージのサブジェクト',
        'description' => '説明',
        'content_html' => 'HTML',
        'content_css' => 'CSS',
        'content_text' => 'プレーンテキスト',
        'test_send' => 'テストメッセージを送信する',
        'test_success' => 'テストメッセージが送信されました。',
        'return' => 'テンプレートリストに戻る'
    ],
    'install' => [
        'project_label' => 'プロジェクト追加',
        'plugin_label' => 'プラグインインストール',
        'missing_plugin_name' => 'インストールするプラグインの名前を指定してください。',
        'install_completing' => 'インストールを仕上げ中',
        'install_success' => 'プラグインをインストールしました。',
    ],
    'updates' => [
        'title' => 'アップデート管理',
        'name' => 'ソフトウェアアップデート',
        'menu_label' => 'アップデート',
        'menu_description' => 'システムの更新、プラグインとテーマの管理とインストール。',
        'check_label' => 'アップデート確認',
        'retry_label' => '再実行',
        'plugin_name' => '名前',
        'plugin_description' => '説明',
        'plugin_version' => 'バージョン',
        'plugin_author' => '作者',
        'plugin_not_found' => 'Plugin not found',
        'core_current_build' => '現在のビルド',
        'core_build' => 'ビルド :build',
        'core_build_help' => '新しいビルドが存在します。',
        'core_downloading' => 'アプリケーションファイルのダウンロード中',
        'core_extracting' => 'アプリケーションファイルの展開中',
        'plugins' => 'プラグイン',
        'plugin_downloading' => 'プラグインダウンロード中： :name',
        'plugin_extracting' => 'プラグイン展開中： :name',
        'plugin_version_none' => '新プラグイン',
        'theme_new_install' => '新しいテーマのインストール',
        'theme_downloading' => "テーマ ':name' をダウンロードしています",
        'theme_extracting' => "テーマ ':name' を展開しています",
        'update_label' => 'ソフトウェアアップデート',
        'update_completing' => 'アップデート仕上げ中',
        'update_loading' => 'アップデートロード中…',
        'update_success' => 'アップデートしました。',
        'update_failed_label' => 'アップデート失敗',
        'force_label' => '強制アップデート',
        'found' => [
            'label' => '新しいアップデートあり',
            'help' => 'アップデートしたいソフトウェアをクリックしてください。',
        ],
        'none' => [
            'label' => 'アップデートなし',
            'help' => '新しいアップデートが見つかりません。',
        ],
    ],
    'server' => [
        'connect_error' => 'サーバー接続エラー。',
        'response_not_found' => '更新サーバーが見つかりません。',
        'response_invalid' => 'サーバーからの無効なレスポンス。',
        'response_empty' => 'サーバーから空のレスポンス。',
        'file_error' => 'サーバーがパッケージ配布に失敗。',
        'file_corrupt' => 'サーバーからのファイルが壊れています。',
    ],
    'behavior' => [
        'missing_property' => ':class クラスは、 :behavior ビヘイビアーにより使用される、 :property プロパティーを定義する必要があります。',
    ],
    'config' => [
        'not_found' => ':location で、 :file 設定ファイルが見つかりません。',
        'required' => ':location　の中の設定で、値の指定が必要な、 :property が見つかりません。',
    ],
    'zip' => [
        'extract_failed' => "コアファイル： ':file' が取り出せません。",
    ],
    'event_log' => [
        'hint' => 'アプリケーションで発生した潜在的なエラーを表示します。例えば、例外やデバッグ情報です。',
        'menu_label' => 'イベントログ',
        'menu_description' => 'システムログメッセージを時間や詳細付きで表示します。',
        'empty_link' => 'イベントログを空にする',
        'empty_loading' => 'イベントログを空にしています...',
        'empty_success' => 'イベントログを空にしました。',
        'return_link' => 'イベントログに戻る',
        'id' => 'ID',
        'id_label' => 'イベントID',
        'created_at' => '日付と時間',
        'message' => 'メッセージ',
        'level' => 'レベル'
    ],
    'request_log' => [
        'hint' => 'This log displays a list of browser requests that may require attention. For example, if a visitor opens a CMS page that cannot be found, a record is created with the status code 404.',
        'menu_label' => 'リクエストログ',
        'menu_description' => '正しくないリクエストやリダイレクトを表示します。例えば "Page not found (404)" です。',
        'empty_link' => 'リクエストログを空にする',
        'empty_loading' => 'リクエストログを空にしています...',
        'empty_success' => 'リクエストログを空にしました。',
        'return_link' => 'リクエストログに戻る',
        'id' => 'ID',
        'id_label' => 'ログID',
        'count' => 'カウンタ',
        'referer' => '参照元',
        'url' => 'URL',
        'status_code' => 'ステータス'
    ],
    'permissions' => [
        'tab' => [
            'manage_site' => 'サイト管理',
            'manage_user' => 'ユーザー管理',
            'manage_workflow' => 'ワークフロー管理',
            'manage_content' => 'コンテンツ管理',
            'manage_comment' => 'コメント管理',
            'manage_mail' => 'メール配信管理',
            'manage_plugin' => 'プラグイン',
        ],
        'manage_site' => [
            'basic_site_setting' => 'ｻｲﾄ基本設定',
            'display_site_setting' => 'ｻｲﾄ表示設定',
            'site_backup' => 'DBバックアップ',
        ],
        'manage_user' => [
            'add_new_user' => 'ユーザー登録',
            'edit_user' => 'ユーザー編集',
            'delete_user' => 'ユーザー削除',
            'add_new_group' => 'グループ登録',
            'edit_group' => 'グループ編集',
            'delete_group' => 'グループ削除',
            'add_many_users' => 'ユーザー 一括登録',
            'add_many_groups' => 'グループ一括登録',
        ],
        'manage_workflow' => [
            'add_new_role' => '役割登録',
            'edit_role' => ' 役割編集',
            'delete_role' => '役割削除',
            'workflow_setting' => 'ワークフロー設定',
        ],
        'manage_content' => [
            'register_theme' => 'テーマ登録',
            'theme_setting' => 'テーマ設定・編集',
            'remove_theme' => 'テーマ削除',
            'add_new_post' => '新規投稿',
            'edit_post_of_mine' => '投稿の編集(自分の)',
            'edit_post_others' => '投稿の編集(他人の)',
            'publish_post' => '投稿の公開',
            'post_accept_fixed_page' => '投稿・固定ﾍﾟｰｼﾞ閲覧',
            'delete_post_of_mine' => '投稿の削除(自分の)',
            'delete_post_others' => ' 投稿の削除(他人の)',
            'add_new_fixed_page' => '固定ﾍﾟｰｼﾞ作成',
            'edit_fixed_page_of_mine' => '固定ﾍﾟｰｼﾞ編集（自分の)',
            'edit_fixed_page_others' => ' 固定ﾍﾟｰｼﾞ編集（他人の)',
            'delete_fixed_page_of_mine' => '固定ﾍﾟｰｼﾞ削除（自分の)',
            'delete_fixed_page_others' => '固定ﾍﾟｰｼﾞ削除（他人の)',
            'publish_fixed_page' => ' 固定ﾍﾟｰｼﾞの公開',
            'menu_setting' => 'メニュー設定',
            'edit_category' => 'カテゴリ編集',
            'edit_tag' => 'タグ編集',
            'approve_post' => '投稿の承認',
            'approve_post_stop' => '投稿の公開中止'
        ],
        'manage_comment' => [
            'approve_comment' => 'コメント承認',
            'remove_comment' => ' コメント削除',
            'blacklist_comment' => 'NGワード登録',
        ],
        'manage_mail' => [
            'mail_setting' => 'メール編集',
            'mail_template' => 'メール配信'
        ],
        'manage_plugin' => [
            'install_plugin' => 'インストール',
            'active_plugin' => '有効化',
            'edit_plugin' => '編集',
            'update_plugin' => 'アップデート',
        ],
        'name' => 'システム',
        'manage_system_settings' => 'システム設定の管理',
        'manage_software_updates' => 'ソフトウェアアップデートの管理',
        'manage_mail_templates' => 'メールテンプレートの管理',
        'manage_other_administrators' => '他のアドミニストレーターの管理',
        'view_the_dashboard' => 'ダッシュボードの表示',
    ],
    'saved'  => [
        'success'   => '保存されました。',
    ],
];
