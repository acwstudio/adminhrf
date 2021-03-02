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
 * App\Models\Article
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $slug
 * @property string|null $announce
 * @property string $body
 * @property bool $show_in_rss
 * @property string|null $yatextid
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAnnounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShowInRss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereYatextid($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $slug
 * @property string|null $firstname
 * @property string $surname
 * @property string|null $patronymic
 * @property \Illuminate\Support\Carbon|null $birth_date
 * @property string|null $announce
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @property-read int|null $articles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereAnnounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUpdatedAt($value)
 */
	class Author extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $alt
 * @property int $order
 * @property int|null $imageable_id
 * @property string|null $imageable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models\Old{
/**
 * App\Models\Old\Article
 *
 * @property int $id
 * @property int $stream_id
 * @property int|null $image_id
 * @property int|null $object3d_id
 * @property int|null $video_id
 * @property int|null $educational_id
 * @property int|null $thread_id
 * @property string $title
 * @property string|null $announce
 * @property string|null $body
 * @property int $total_votes
 * @property bool|null $vote_active
 * @property string|null $vote_start
 * @property string|null $vote_end
 * @property string|null $date
 * @property string|null $format_date
 * @property mixed $quotes
 * @property string $updatedat
 * @property string $slug
 * @property int|null $listorder
 * @property bool|null $showinmain
 * @property bool|null $close_commentation
 * @property string|null $date_event
 * @property string $from_date
 * @property bool|null $status
 * @property bool|null $show_in_rss
 * @property string|null $yatextid
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_keywords
 * @property bool|null $featured
 * @property string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Old\Person[] $authors
 * @property-read int|null $authors_count
 * @property-read \App\Models\Old\Image|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAnnounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCloseCommentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDateEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereEducationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFormatDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereListorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereObject3dId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereQuotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShowInRss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShowinmain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTotalVotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereVoteActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereVoteEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereVoteStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereYatextid($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models\Old{
/**
 * App\Models\Old\Image
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $enabled
 * @property string $provider_name
 * @property int $provider_status
 * @property string $provider_reference
 * @property mixed|null $provider_metadata
 * @property int|null $width
 * @property int|null $height
 * @property string|null $length
 * @property string|null $content_type
 * @property int|null $content_size
 * @property string|null $copyright
 * @property string|null $author_name
 * @property string|null $context
 * @property bool|null $cdn_is_flushable
 * @property string|null $cdn_flush_at
 * @property int|null $cdn_status
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\Old\Article $article
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCdnFlushAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCdnIsFlushable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCdnStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereContentSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCopyright($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereProviderMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereProviderReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereProviderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereWidth($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models\Old{
/**
 * App\Models\Old\Person
 *
 * @property int $id
 * @property int|null $period_id
 * @property int|null $image_id
 * @property int|null $gallery_id
 * @property int $stream_id
 * @property int|null $thread_id
 * @property string|null $surname
 * @property string|null $firstname
 * @property string|null $patronymic
 * @property string|null $announce
 * @property string|null $description
 * @property string|null $birth_date
 * @property string|null $format_birth_date
 * @property string|null $death_date
 * @property string|null $format_death_date
 * @property mixed|null $biblio
 * @property string $updatedat
 * @property string $slug
 * @property bool|null $close_commentation
 * @property bool|null $show_in_rss
 * @property string|null $date
 * @property string|null $complex_birth_date
 * @property string|null $complex_death_date
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_keywords
 * @property int|null $government_start
 * @property int|null $government_end
 * @property string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Old\Article[] $articles
 * @property-read int|null $articles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAnnounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBiblio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCloseCommentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereComplexBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereComplexDeathDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDeathDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFormatBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFormatDeathDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGalleryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGovernmentEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGovernmentStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePeriodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereShowInRss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUrl($value)
 */
	class Person extends \Eloquent {}
}

namespace App\Models\Old{
/**
 * App\Models\Old\User
 *
 * @property int $id
 * @property string $username
 * @property string $username_canonical
 * @property string $email
 * @property string $email_canonical
 * @property bool $enabled
 * @property string $salt
 * @property string $password
 * @property string|null $last_login
 * @property bool $locked
 * @property bool $expired
 * @property string|null $expires_at
 * @property string|null $confirmation_token
 * @property string|null $password_requested_at
 * @property mixed $roles
 * @property bool $credentials_expired
 * @property string|null $credentials_expire_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $date_of_birth
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $website
 * @property string|null $biography
 * @property string|null $gender
 * @property string|null $locale
 * @property string|null $timezone
 * @property string|null $phone
 * @property string|null $facebook_uid
 * @property string|null $facebook_name
 * @property mixed|null $facebook_data
 * @property string|null $twitter_uid
 * @property string|null $twitter_name
 * @property mixed|null $twitter_data
 * @property string|null $gplus_uid
 * @property string|null $gplus_name
 * @property mixed|null $gplus_data
 * @property string|null $token
 * @property string|null $two_step_code
 * @property string|null $patronymic
 * @property string|null $place_of_birth
 * @property string|null $delegate_info
 * @property string|null $work
 * @property string|null $post
 * @property string|null $education
 * @property string|null $degrees
 * @property string|null $fakultet
 * @property string|null $course
 * @property string|null $school
 * @property string|null $class
 * @property string|null $educational_institution
 * @property string|null $prepupil_class
 * @property string|null $creator
 * @property string|null $publications
 * @property string|null $suggestions
 * @property string|null $activity
 * @property string|null $shortinfo
 * @property string|null $bigbiography
 * @property string|null $facebook_id
 * @property string|null $facebook_access_token
 * @property string|null $vkontakte_id
 * @property string|null $vkontakte_access_token
 * @property string|null $twitter_id
 * @property string|null $twitter_access_token
 * @property string|null $twitter_access_token_secret
 * @property bool|null $has_avatar
 * @property string|null $registration_address
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBigbiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCredentialsExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCredentialsExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDegrees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDelegateInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEducationalInstitution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFakultet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGplusData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGplusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGplusUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHasAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordRequestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrepupilClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShortinfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSuggestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterAccessTokenSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitterUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoStepCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsernameCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWork($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SocialUser
 *
 * @property int $id
 * @property int $user_id
 * @property string $external_id
 * @property string $service
 * @property array $external_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereExternalUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialUser whereUserId($value)
 */
	class SocialUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property bool $legacy
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SocialUser[] $socials
 * @property-read int|null $socials_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLegacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

