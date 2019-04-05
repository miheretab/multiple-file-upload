<?php
namespace MultipleFileUpload\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property string $name
 * @property float $size
 * @property int $project_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Project $project
 */
class File extends Entity
{
	protected $_virtual = ['size_mb'];
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'size' => true,
        'project_id' => true,
        'created' => true,
        'modified' => true,
        'project' => true
    ];

    protected function _getSizeMb()
    {
		$sizeMB = $this->size / (1024 * 1024);
        return $sizeMB < 1 ? number_format(round($this->size / 1024, 2)).' KB' : number_format(round($sizeMB), 2).' MB';
    }
}
