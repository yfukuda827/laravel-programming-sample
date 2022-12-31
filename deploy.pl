#!/usr/bin/perl
#
# deploy script for AWS amazonlinux2/PHP8.0
#

use strict;
use warnings;

# コマンドパスの定義
use constant CMD_GIT => '/usr/bin/git';
use constant CMD_PHP => '/usr/bin/php';
use constant CMD_COMPOSER => '/usr/local/bin/composer';
use constant CMD_NPM => '/usr/bin/npm';
use constant CMD_SUDO => '/usr/bin/sudo';
use constant USER_WEB => 'apache';

use Cwd ();
use File::Basename ();

# 動作パス
use constant SCRIPT_PATH =>  Cwd::abs_path($0);												# ~shimecs/RELEASE/deploy_root.pl
use constant SCRIPT_DIR  =>  File::Basename::dirname(SCRIPT_PATH).'/';						# ~shimecs/RELEASE/
use constant SCRIPT_NAME => (File::Basename::fileparse($0, qr/\..*$/))[0];					# deploy_root

# ワークディレクトリを移動する
chdir SCRIPT_DIR;

# リリース実行(git pull)
system(CMD_GIT, 'checkout', '.');  # 先にローカルでの変更を破棄
system(CMD_GIT, 'pull', 'origin', 'main'); #main branch

# work directoryの移動
chdir SCRIPT_DIR.'laravel';

# composerパッケージの再導入
system(CMD_COMPOSER, 'install');

# DB migration 実行
system(CMD_SUDO, '-u', USER_WEB, CMD_PHP, 'artisan', 'migrate', '--force');

# public/storage が存在しないなら作成する
if( ! -e "public/storage" ){
    system(CMD_PHP, 'artisan', 'storage:link');
}

# nodeの実行
#system(CMD_NPM, 'install');

# 環境変数を追加してnpmの実行
#system(CMD_NPM, 'run', 'prod');

# キャッシュ類クリア
system(CMD_SUDO, '/bin/sh', '../.docker/laravel/clrcache.sh');

exit(0);

