<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace LaravelGovernorTests{
/**
 * LaravelGovernorTests\Team
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\config('auth.model')[] $users
 * @property-read \config('auth.model') $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|Invitation[] $invitations
 */
	class Team {}
}

namespace LaravelGovernorTests{
/**
 * LaravelGovernorTests\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $deleted_at
 * @property-read mixed $using_two_factor_auth
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\LaravelGovernorTests\User whereDeletedAt($value)
 */
	class User {}
}

