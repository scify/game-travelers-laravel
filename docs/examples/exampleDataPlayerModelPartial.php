<?php
/**
 * Example Player Model class for the "Travelers" Laravel project.
 * Warning: This was created as a thought experiment to understand which parts
 * of it are needed for creating the corresponding Views. It seems that the
 * only required elements are the player_id, the player's name and the player's
 * selected avatar_id, so there's not much to do in here and it should be
 * properly extended to include any potential settings which could be stored in
 * the player's profile. Regardless, here is the result.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Avatar; // I guess a Profile Model is needed.
use App\Models\User; // I guess a Profile Model is needed.

class Player extends Model
{
    use User, Avatar;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "colour", // @TODO: Colour: int|random|1-5. Basically, each new player
                  // will get a randomly assigned number from 1 to 6. Then it's
                  // avatar will be displayed the corresponding colour as the
                  // background in its circle, INSTEAD of the default white (0).
                  // This would help a lot in the select a Player screen and in
                  // other parts of the UI to distinguish players more easily.
                  // This color could also be used in pawns, or even in the
                  // board itself. This will be a good feature for a future so
                  // let's at least introduce this field in the database for
                  // now?
    ];

    /**
     * The validation rules for the model's attributes.
     *
     * @var array
     */
    public static $rules = [
        // Note that 50 characters is the maximum allowed via the form. In
        // practice though, the real limit for the (first) name  should be even
        // lower as only 8-10 characters can fit under the 100x100 buttons on
        // the UI and the rest characters are ellipsed. I would say "10" to
        // enforce names similar to the ones provided in the ideal scenario of
        // the mock-ups.
        "name" => "required|string|max:50",
        "avatar_id" => "required|integer|exists:avatars,id",
    ];

    /**
     * The user associated with the player.
     *
     * Don't forget to add the opposite relation (players) to the User Model.
     * <code>
     * <?php
     * public function players()
     *  {
     *    return $this->hasMany(Player::class);
     *  }
     * ?>
     * </code>
     * You can then use it to retrieve all players associated with a user.
     * <code>
     * <?php
     * $players = $user->players;
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
     * The avatar associated with the player.
     *
     * The easiest method to get the avatar attached to a player.
     * <code>
     * <?php
     * $avatar = $player->avatar;
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
