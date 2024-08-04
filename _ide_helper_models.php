<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BatteryTest
 *
 * @property int $id
 * @property int $test_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereOrder($value)
 * @property int $battery_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereBatteryId($value)
 * @property-read \App\Models\Test $test
 */
	class BatteryTest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Battery
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereUserId($value)
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereIsDefault($value)
 */
	class Battery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientEmailLog
 *
 * @property int $id
 * @property int $client_id
 * @property int $type
 * @property int $relate_object_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereRelateObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ClientEmailLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $test_id
 * @property int $type
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Question extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class User.
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $avatar_type
 * @property string|null $avatar_location
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $password_changed_at
 * @property bool $active
 * @property string|null $confirmation_code
 * @property bool $confirmed
 * @property string|null $timezone
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property bool $to_be_logged_out
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $full_name
 * @property-read string $name
 * @property-read string $permissions_label
 * @property-read mixed $picture
 * @property-read string $roles_label
 * @property-read \Illuminate\Database\Eloquent\Collection|\Altek\Accountant\Models\Ledger[] $ledgers
 * @property-read int|null $ledgers_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\PasswordHistory[] $passwordHistories
 * @property-read int|null $password_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\SocialAccount[] $providers
 * @property-read int|null $providers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User active($status = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User confirmed($confirmed = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\BaseUser uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereAvatarLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereAvatarType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereConfirmationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User wherePasswordChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereToBeLoggedOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\User whereUuid($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class Role.
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Altek\Accountant\Models\Ledger[] $ledgers
 * @property-read int|null $ledgers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class PasswordHistory.
 *
 * @property int $id
 * @property int $user_id
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\PasswordHistory whereUserId($value)
 * @mixin \Eloquent
 */
	class PasswordHistory extends \Eloquent {}
}

namespace App\Models\Auth{
/**
 * Class SocialAccount.
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string|null $token
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Altek\Accountant\Models\Ledger[] $ledgers
 * @property-read int|null $ledgers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\SocialAccount whereUserId($value)
 * @mixin \Eloquent
 */
	class SocialAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserOrg
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereUserId($value)
 * @mixin \Eloquent
 */
	class UserOrg extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientTestResult
 *
 * @property int $id
 * @property int $client_id
 * @property int $test_id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array $config
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereConfig($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientTestResultQuestion[] $test_result_questions
 * @property-read int|null $test_result_questions_count
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Test $test
 */
	class ClientTestResult extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientTestResultQuestion
 *
 * @property int $id
 * @property int $test_result_id
 * @property int $question_id
 * @property string $title
 * @property string $config
 * @property int $type
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereTestResultId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ClientTestResultQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Test
 *
 * @property int $id
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereDescription($value)
 */
	class Test extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientBattery
 *
 * @property int $id
 * @property int $client_id
 * @property int $battery_id
 * @property string $start_date
 * @property string $end_date
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereBatteryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Battery $battery
 * @property-read \App\Models\Client $client
 */
	class ClientBattery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Answer
 *
 * @property int $id
 * @property int $question_id
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Answer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $personal_code
 * @property string $birth_date
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePersonalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUserId($value)
 * @mixin \Eloquent
 * @property int $gender
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereGender($value)
 * @property-read \App\Models\Auth\User $user
 * @property int $org_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereOrgId($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientTestResultAnswer
 *
 * @property int $id
 * @property int $test_result_question_id
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereTestResultQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ClientTestResultAnswer extends \Eloquent {}
}

