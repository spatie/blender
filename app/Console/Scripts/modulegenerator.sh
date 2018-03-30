#!/usr/bin/env bash

# Usage: modulegenerator Raccoon Raccoons => Generates a raccoon module

singular="$1"
lcsingular="$(tr '[:upper:]' '[:lower:]' <<< ${singular:0:1})${singular:1}"
plural="$2"
lcplural="$(tr '[:upper:]' '[:lower:]' <<< ${plural:0:1})${plural:1}"
now=$(date +"%Y_%m_%d_%H%M%S")

function generate() {
    cp "$1" "$2"
    sed -i '' "s/NewsItems/${plural}/g" "$2"
    sed -i '' "s/newsItems/${lcplural}/g" "$2"
    sed -i '' "s/NewsItem/${singular}/g" "$2"
    sed -i '' "s/newsItem/${lcsingular}/g" "$2"
    sed -i '' "s/news_items/${lcplural}/g" "$2"
    sed -i '' "s/news_item/${lcsingular}/g" "$2"
    sed -i '' "s/News/${plural}/g" "$2"
    sed -i '' "s/news/${lcplural}/g" "$2"
}

# Model & related objects
generate  app/Models/NewsItem.php                               app/Models/${singular}.php
generate  app/Models/Presenters/NewsItemPresenter.php           app/Models/Presenters/${singular}Presenter.php

# Repositories
generate  app/Repositories/NewsItemRepository.php             app/Repositories/${singular}Repository.php

# Http
generate  app/Http/Controllers/Back/NewsController.php      app/Http/Controllers/Back/${plural}Controller.php
generate  app/Http/Requests/Back/NewsItemRequest.php        app/Http/Requests/Back/${singular}Request.php

# Views
mkdir -p resources/views/back/${lcplural}/partials
generate  resources/views/back/news/partials/form.blade.php  resources/views/back/${lcplural}/partials/form.blade.php
generate  resources/views/back/news/index.blade.php           resources/views/back/${lcplural}/index.blade.php
generate  resources/views/back/news/edit.blade.php            resources/views/back/${lcplural}/edit.blade.php

# Database
generate  database/factories/NewsItemFactory.php                            database/factories/${singular}Factory.php
generate  database/seeds/NewsItemSeeder.php                                 database/seeds/${singular}Seeder.php
generate  database/migrations/2015_05_26_153558_create_news_items_table.php  database/migrations/${now}_create_${lcplural}_table.php

# Todos
echo "ALL DONE!"
echo "- Todo: Register seeder in DatabaseSeeder"
echo "- Todo: Register Blender routes in routes/back.php"
echo "- Todo: Register Blender navigation in App\Services\Navigation\Menu\BackMenus"
