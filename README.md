# MultipleFileUpload plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).


create MultipleFileUpload folder into plugins folder and do:
```
composer dumpautoload
```

Run db migration:
```
bin/cake migrations migrate -p MultipleFileUpload
```
or execute sql/files.sql

You need to have project model in your cakephp application

and add the ff to the ProjectsTable

```
$this->hasMany('Files', [
	'foreignKey' => 'project_id',
	'className' => 'MultipleFileUpload.Files'
]);
```

store max file size in .env FILE_MAX_SIZE_MB, by default it is 1MB

You can view, download and remove files in a project using this url (.../multiple-file-upload/files/view/PROJECT_ID), replace PROJECT_ID with your real project id.

here is what it looks like:
![alt text](https://snag.gy/2BCeDi.jpg)
