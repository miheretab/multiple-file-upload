# MultipleFileUpload plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).


put MultipleFileUpload folder into plugins and do:
```
composer dumpautoload
```

or manual installation by modifying your application composer.json like this:

```
    "autoload": {
        "psr-4": {
            //....
            "MultipleFileUpload\\": "./plugins/MultipleFileUpload/src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            //...
            "MultipleFileUpload\\Test\\": "./plugins/MultipleFileUpload/tests/"
        }
    },
```

add this line to src/Application.php
```
$this->addPlugin('MultipleFileUpload');
```

Run db migration:
```
bin/cake migrations migrate -p MultipleFileUpload
```
or execute sql/files.sql

You need to have project model in your cakephp application

and add the ff to the ProjectTable

```
$this->hasMany('Files', [
	'foreignKey' => 'project_id',
	'className' => 'MultipleFileUpload.Files'
]);
```

store these variables in .env
FILE_MAX_SIZE_MB=1, by default it is 1MB
PROJECT_MODEL_NAME=Projects, by default it is Projects

