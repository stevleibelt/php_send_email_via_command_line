{"reqId":"Yrw1Q8OXeVxD65uDiu-E5QAAANM","level":3,"time":"2022-06-29T11:19:32+00:00","remoteAddr":"139.20.136.86","user":"artodeto","app":"settings","method":"POST","url":"/index.php/settings/apps/enable","message":"could not enable apps","userAgent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.53 Safari/537.36","version":"24.0.2.1","exception":{"Exception":"Exception","Message":"Database error when running migration 010206Date20201223134353 for app cospend\nThere is no table with name 'bazzline_cloud.oc_cospend_categories' in the schema.","Code":0,"Trace":[{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/Installer.php","line":154,"function":"migrate","class":"OC\\DB\\MigrationService","type":"->","args":["latest",false]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/apps/settings/lib/Controller/AppSettingsController.php","line":451,"function":"installApp","class":"OC\\Installer","type":"->","args":["cospend"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/AppFramework/Http/Dispatcher.php","line":225,"function":"enableApps","class":"OCA\\Settings\\Controller\\AppSettingsController","type":"->","args":[["cospend"],[]]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/AppFramework/Http/Dispatcher.php","line":133,"function":"executeController","class":"OC\\AppFramework\\Http\\Dispatcher","type":"->","args":[{"__class__":"OCA\\Settings\\Controller\\AppSettingsController"},"enableApps"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/AppFramework/App.php","line":172,"function":"dispatch","class":"OC\\AppFramework\\Http\\Dispatcher","type":"->","args":[{"__class__":"OCA\\Settings\\Controller\\AppSettingsController"},"enableApps"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/Route/Router.php","line":298,"function":"main","class":"OC\\AppFramework\\App","type":"::","args":["OCA\\Settings\\Controller\\AppSettingsController","enableApps",{"__class__":"OC\\AppFramework\\DependencyInjection\\DIContainer"},["settings.AppSettings.enableApps"]]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/base.php","line":1023,"function":"match","class":"OC\\Route\\Router","type":"->","args":["/settings/apps/enable"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/index.php","line":36,"function":"handleRequest","class":"OC","type":"::","args":[]}],"File":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/DB/MigrationService.php","Line":429,"Previous":{"Exception":"Doctrine\\DBAL\\Schema\\SchemaException","Message":"There is no table with name 'bazzline_cloud.oc_cospend_categories' in the schema.","Code":10,"Trace":[{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/3rdparty/doctrine/dbal/src/Schema/Schema.php","line":180,"function":"tableDoesNotExist","class":"Doctrine\\DBAL\\Schema\\SchemaException","type":"::","args":["bazzline_cloud.oc_cospend_categories"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/DB/SchemaWrapper.php","line":90,"function":"getTable","class":"Doctrine\\DBAL\\Schema\\Schema","type":"->","args":["bazzline_cloud.oc_cospend_categories"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/apps/cospend/lib/Migration/Version010206Date20201223134353.php","line":62,"function":"getTable","class":"OC\\DB\\SchemaWrapper","type":"->","args":["cospend_categories"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/DB/MigrationService.php","line":532,"function":"changeSchema","class":"OCA\\Cospend\\Migration\\Version010206Date20201223134353","type":"->","args":[{"__class__":"OC\\Migration\\SimpleOutput"},{"__class__":"Closure"},["oc_"]]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/DB/MigrationService.php","line":425,"function":"executeStep","class":"OC\\DB\\MigrationService","type":"->","args":["010206Date20201223134353",false]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/Installer.php","line":154,"function":"migrate","class":"OC\\DB\\MigrationService","type":"->","args":["latest",false]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/apps/settings/lib/Controller/AppSettingsController.php","line":451,"function":"installApp","class":"OC\\Installer","type":"->","args":["cospend"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/AppFramework/Http/Dispatcher.php","line":225,"function":"enableApps","class":"OCA\\Settings\\Controller\\AppSettingsController","type":"->","args":[["cospend"],[]]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/AppFramework/Http/Dispatcher.php","line":133,"function":"executeController","class":"OC\\AppFramework\\Http\\Dispatcher","type":"->","args":[{"__class__":"OCA\\Settings\\Controller\\AppSettingsController"},"enableApps"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/AppFramework/App.php","line":172,"function":"dispatch","class":"OC\\AppFramework\\Http\\Dispatcher","type":"->","args":[{"__class__":"OCA\\Settings\\Controller\\AppSettingsController"},"enableApps"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/private/Route/Router.php","line":298,"function":"main","class":"OC\\AppFramework\\App","type":"::","args":["OCA\\Settings\\Controller\\AppSettingsController","enableApps",{"__class__":"OC\\AppFramework\\DependencyInjection\\DIContainer"},["settings.AppSettings.enableApps"]]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/lib/base.php","line":1023,"function":"match","class":"OC\\Route\\Router","type":"->","args":["/settings/apps/enable"]},{"file":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/index.php","line":36,"function":"handleRequest","class":"OC","type":"::","args":[]}],"File":"/var/www/virtual/bazzline/data/net/bazzline/cloud/public/3rdparty/doctrine/dbal/src/Schema/SchemaException.php","Line":35},"CustomMessage":"could not enable apps"}}