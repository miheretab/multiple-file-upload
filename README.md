# MultipleFileUpload plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).


put MultipleFileUpload folder into plugins and do:
```
composer dumpautoload
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

store max file size in .env FILE_MAX_SIZE_MB, by default it is 1MB
