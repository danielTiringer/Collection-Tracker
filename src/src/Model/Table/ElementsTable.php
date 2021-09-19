<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Josegonzalez\Upload\Validation\DefaultValidation;

/**
 * Elements Model
 *
 * @property \App\Model\Table\CollectionsTable&\Cake\ORM\Association\BelongsTo $Collections
 * @method \App\Model\Entity\Element newEmptyEntity()
 * @method \App\Model\Entity\Element newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Element[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Element get($primaryKey, $options = [])
 * @method \App\Model\Entity\Element findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Element patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Element[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Element|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Element saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Element[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Element[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Element[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Element[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ElementsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('elements');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Collections', [
            'foreignKey' => 'collection_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'path' => 'webroot{DS}img{DS}element-img{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    $currentDateTime = (new Time('now'))->format('YmdHis');

                    return $currentDateTime . '_' . $data->getClientFileName();
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    return [$path . $entity->{$field}];
                },
                'keepFilesOnDelete' => false,
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator->setProvider('upload', DefaultValidation::class);

        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('source')
            ->maxLength('source', 255)
            ->allowEmptyString('source');

        $validator
            ->allowEmptyFile('image', null)
            ->add('image', [
                'mimeType' => [
                    'rule' => ['mimeType', ['image/jpg', 'image/png', 'image/jpeg']],
                    'message' => 'Only jpg, jpeg and png files can be uploaded.',
                ],
                'fileBelowMaxSize' => [
                    'rule' => ['isBelowMaxSize', 10 * 1024 * 1024 * 1024],
                    'message' => 'Image file size must be less than 10MB.',
                    'provider' => 'upload',
                ],
                'fileCompletedUpload' => [
                    'rule' => 'isCompletedUpload',
                    'message' => 'This file could not be uploaded completely',
                    'provider' => 'upload',
                ],
            ]);

        $validator
            ->scalar('metadata')
            ->maxLength('metadata', 255)
            ->allowEmptyString('metadata');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['collection_id'], 'Collections'), ['errorField' => 'collection_id']);

        return $rules;
    }

    /**
     * Lifecycle callback after saving an entity
     *
     * @param \Cake\Event\Event $event The event
     * @param \Cake\Datasource\EntityInterface $entity The entity
     * @param \ArrayObject $options Custom options
     * @return void
     */
    public function afterSave(Event $event, EntityInterface $entity, ArrayObject $options): void
    {
        $previousImage = WWW_ROOT . 'img' . DS . 'element-img' . DS . $options['previousImageName'];

        if (is_file($previousImage)) {
            unlink($previousImage);
        }
    }
}
