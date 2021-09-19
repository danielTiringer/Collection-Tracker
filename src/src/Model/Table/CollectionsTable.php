<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Josegonzalez\Upload\Validation\DefaultValidation;

/**
 * Collections Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ElementsTable&\Cake\ORM\Association\HasMany $Elements
 * @method \App\Model\Entity\Collection newEmptyEntity()
 * @method \App\Model\Entity\Collection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Collection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Collection get($primaryKey, $options = [])
 * @method \App\Model\Entity\Collection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Collection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Collection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Collection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Collection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Collection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Collection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Collection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Collection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CollectionsTable extends Table
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

        $this->setTable('collections');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Elements');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'path' => 'webroot{DS}img{DS}collection-img{DS}',
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
            ->allowEmptyString('goal', null);

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
        $rules->add($rules->existsIn(['users_id'], 'Users'), ['errorField' => 'users_id']);

        return $rules;
    }
}
