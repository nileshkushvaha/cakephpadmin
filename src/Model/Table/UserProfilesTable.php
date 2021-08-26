<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfiles Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\DistrictsTable|\Cake\ORM\Association\BelongsTo $Districts
 *
 * @method \App\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserProfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserProfilesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->date('date_of_birth')
            ->allowEmpty('date_of_birth');

        $validator
            ->scalar('organization')
            ->maxLength('organization', 250)
            ->allowEmpty('organization');

        $validator
            ->scalar('shortname')
            ->maxLength('shortname', 100)
            ->allowEmpty('shortname');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 100)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('middle_name')
            ->maxLength('middle_name', 100)
            ->allowEmpty('middle_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 100)
            ->allowEmpty('last_name');

        $validator
            ->integer('gender')
            ->allowEmpty('gender');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 15)
            ->allowEmpty('mobile_number');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 15)
            ->allowEmpty('phone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 15)
            ->allowEmpty('fax');

        $validator
            ->scalar('country')
            ->maxLength('country', 100)
            ->allowEmpty('country');

        $validator
            ->scalar('city_name')
            ->maxLength('city_name', 100)
            ->allowEmpty('city_name');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmpty('address');

        $validator
            ->integer('pincode')
            ->allowEmpty('pincode');

        $validator
            ->scalar('profile_photo')
            ->maxLength('profile_photo', 255)
            ->allowEmpty('profile_photo');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmpty('website');

        $validator
            ->integer('star')
            ->allowEmpty('star');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));

        return $rules;
    }
}
