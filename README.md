# coozo
coozo（食うぞ）は次世代型ランチメニュー検索サービスです。
町を大きなフードコートに見立てて、レストランではなく食べたい料理から検索して比較検討する事ができます。
例えばラーメンを食べたい場合にお店単位ではなく個々のメニューで人気順に各料理の写真を比較しながら選ぶ事ができます。

# Service URL
http://coozo.co

# Requirement

* Linux
* Apache
* MySQL
* PHP

# Prepare following files as git submodules

    $ git submodule init
    $ git submodule update

# Prepare the Phpunit source

    $ cd {menu_search_env}/app
    $ Console/cake Phpunit.Phpunit install

（略）
Installing PHPUnit 3.7 ...
1. /app/Vendor/
2. /vendors/
Select VENDOR path to install into (q/1/2)
[q] > 1

* インストール場所を聞かれるので、「app/Vendor」を選択

# Prepare Opauth source

    $ cd {menu_search_env}/app/Plugin/Opauth
    $ git checkout master
    $ git submodule init
    $ git submodule update

