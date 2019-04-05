<?php

namespace MultipleFileUpload\Controller;

use MultipleFileUpload\Controller\AppController;
use Cake\Filesystem\Folder;

class FilesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function view($projectId) {
		$files = $this->Files->find('all', ['conditions' => ['project_id' => $projectId], 'order' => ['created' => 'DESC']]);
		$this->set(compact('files', 'projectId'));
		//$this->set('_serialize', ['files']);
		if($this->request->is('Ajax')) {
			$this->render('view_files');
		}
    }

    public function upload($projectId) {
		$this->autoRender = false;
		$this->loadModel('App.Projects');
		if ($project = $this->Projects->get($projectId) && $this->request->is(['patch', 'post', 'put'])) {
			$errors = [];
			$maxFileSize = env('FILE_MAX_SIZE_MB', 1) * 1024 * 1024;
			foreach($this->request->data['files'] as $i => $file) {
				$filename = $file['name'];

				if(!empty($file['tmp_name']) && $file['size'] > 0 && is_uploaded_file($file['tmp_name'])) {
					if($file['size'] < $maxFileSize) {
						$dir = new Folder(ROOT . DS . 'files' . DS . $projectId, true, 0777);//var_dump($dir->pwd());exit;
						$uploaded = move_uploaded_file($file['tmp_name'], $dir->pwd() . DS . $filename);
						if($uploaded) {
							$projectFileArr['size'] = $file['size'];
							$projectFileArr['name'] = $filename;
							$projectFileArr['project_id'] = $projectId;
							$projectFileArr['created'] = $projectFileArr['modified'] = date('Y-m-d H:i:s');

							$projectFile = $this->Files->newEntity();
							$projectFile = $this->Files->patchEntity($projectFile, $projectFileArr);
							$this->Files->save($projectFile);
						}
					} else {
						$errors[] = 'File ' . $filename . ' is exceded max amount ' . $maxFileSize;
					}
				} else if($file['size'] > 0 && !is_uploaded_file($file['tmp_name'])) {
					$errors[] = 'File ' . $filename . ' is not uploadable.';
				}
			}
			if(!empty($errors)) {
				return $this->response->withType('application/json')->withStringBody(json_encode(['error' => $errors, 'projectId' => $projectId]));
			} else {
				return $this->response->withType('application/json')->withStringBody(json_encode(['success' => true, 'message' => 'Successfully Uploaded', 'projectId' => $projectId]));
			}
		
		}
    }

    public function download($id) {
		$this->autoRender = false;
		$projectFile = $this->Files->get($id);
		$filePath = ROOT .DS . 'files'. DS . $projectFile->project_id . DS . $projectFile->name;
		if($projectFile && file_exists($filePath)) {
			$this->response->file($filePath, ['download'=> true, 'name'=> $projectFile->name]);
		}
	}

    public function remove($id) {
		$this->autoRender = false;
        $projectFile = $this->Files->get($id);
		$filePath = ROOT . DS . 'files' . DS . $projectFile->project_id . DS. $projectFile->name;
		if($projectFile) {
			if(file_exists($filePath)) {
				unlink($filePath);
			}
			if ($this->Files->delete($projectFile)) {
				return $this->response->withType('application/json')->withStringBody(json_encode(['success' => true, 'message' => 'Successfully Removed', 'id' => $id]));
			}
		}
		return $this->response->withType('application/json')->withStringBody(json_encode(['error' => true]));
    }
}