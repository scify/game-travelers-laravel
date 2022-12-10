<?php
/**
 * Example Profile Model class for the "Travelers" Laravel project.
 * Warning: This was created as a thought experiment to understand which parts
 * of it are needed for creating the corresponding Views. It seems that the
 * only required elements are the profile_id, the name and the avatar_id, so
 * there's not much to do in here and it should be properly extended to include
 * any potential settings which could be stored in the profile. Regardless,
 * here is the result of this thought experiment, which was much shorter than
 * the Avatar model, which turned out to be almost fully implemented (but
 * remains untested).
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Avatar; // I guess a Profile Model is needed.
use App\Models\User; // I guess a Profile Model is needed.

class Profile extends Model
{
    use User, Avatar;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
    ];

    /**
     * The validation rules for the model's attributes.
     *
     * @var array
     */
    public static $rules = [
        "name" => "required|string|max:50",
        "avatar_id" => "required|integer|exists:avatars,id",
    ];

    /**
     * The user associated with the profile.
     *
     * Don't forget to add the opposite relation (profiles) to the User Model.
     * <code>
     * <?php
     * public function profiles()
     *  {
     *    return $this->hasMany(Profile::class);
     *  }
     * ?>
     * </code>
     * You can then use it to retrieve all profiles associated with a user.
     * <code>
     * <?php
     * $profiles = $user->profiles;
     * ?>
     * </code>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The avatar associated with the profile.
     *
     * The easiest method to get the avatar attached to a profile.
     * <code>
     * <?php
     * $avatar = $profile->avatar;
     * ?>
     * </code>
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

}
