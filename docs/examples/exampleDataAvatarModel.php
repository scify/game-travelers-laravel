<?php
/**
 * Example Avatar Model class for the "Travelers" Laravel project.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile; // I guess a Profile Model is needed.

/**
 * Avatar model represents an avatar data record.
 *
 * It should be noted that this Model has not been tested. In other words, it's
 * merely a thought experiment with the purpose of building a hopefully usable
 * class in Laravel. Note that the default template only supports avatars of
 * 100x100 pixels (1:1 ratio) in PNG format and assumes that a @2x.png with the
 * same filename is also provided in the same folder.
 *
 * @property int $id The primary key for the avatar data record.
 * @property string $asset The asset name for the avatar (without extensions).
 * @property string $description The ("alt") description for the avatar.
 * @property string $public_path The public path for the asset.
 *   The default value is "images/avatars".
 * @property int $width The width of the 1x asset in pixels (default:100).
 * @property int $height The height of the 1x asset in pixels (default:100).
 */
class Avatar extends Model
{
    use Profile;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avatars';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        "asset",
        "description",
        "public_path",
        "width",
        "height",
    ];

    /**
     * The default values for the model's attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        "width" => 100,
        "height" => 100,
        "public_path" => "images/avatars",
    ];

    /**
     * The validation rules for the model's attributes.
     *
     * These rules are used to validate the data before it is saved to the
     * database. Obviously they are not really needed, but yet, here they are.
     *
     * @var array<string, string>
     */
    public static $rules = [
        "id" => "required|integer|unique:avatars", // why (not)
        "asset" => "required",
        "description" => "required",
        "width" => "integer|min:50|max:200|same:height", // 1:1!
        "height" => "integer|min:50|max:200|same:width", // 1:1!
    ];

    /**
     * Get the profiles that the avatar is associated with.
     *
     * Note that avatars are assigned to profiles of users, not directly to
     * users. Why could we possibly need this function I don't really know, but
     * my thought experiment has no actual limits. The reverse relationship on
     * the Profile class Model could be defined like this:
     * public function avatar()
     * {
     *    return $this->hasOne(Avatar::class);
     * }
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    /**
     * Retrieve an avatar data record by its ID.
     *
     * @param int $id The ID of the avatar data record to retrieve.
     * @return \App\Models\Avatar|null The avatar data record.
     */
    public static function findById($id)
    {
        return static::where("id", $id)->first();
    }

    /**
     * Returns an array of all avatars.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getAllAvatars()
    {
        $avatars = self::all();
        $list = [];
        foreach ($avatars as $avatar) {
            $list[$avatar->id] = [
                "id" => $avatar->id,
                "asset" => $avatar->asset,
                "description" => $avatar->description,
                "publicPath" => $avatar->public_path,
                "width" => $avatar->width,
                "height" => $avatar->height,
            ];
        }
    }
}
