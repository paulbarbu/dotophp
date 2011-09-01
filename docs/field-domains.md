* user.{first_name, last_name}:
    * \p{Ll} | \p{Lu} | \p{Nd} | U+002D | U+005F
    * min. length: 1 char
    * max. length: 20 chars
* user.nick, {category, event}.name:
    * [a-z0-9_-]
    * min.length: 1 char
    * max. length: 20 chars
* user.{created, activated, birthday}, alarm.date, event.{start, end}: timestamp
* {user, category, event}.description:
    * \p{Ll} | \p{Lu} | \p{Nd} | \p{Po} | \p{Ps} | \p{Pe} | \p{Sm} | \p{Pd}
    * max. length: 100
* user.email:
    * [a-z0-9_-@\.]
    * min. length: 5 chars
    * max. length: 255 chars
* user.{security_q, security_a}:
    * \p{Ll} | \p{Lu} | \p{Po} | \p{Nd}
    * min. length: 8 chars
    * max. length: 255 chars
* {user, event}.private, event.exception: {0, 1} (FALSE, TRUE)
* user.timezone:
    * [a-z/]
    * max. length: 27 chars
* user.city:
    * \p{Lu} | \p{Ll}
    * max. length: 30 chars
* user.phone:
    * [0-9()-\s/]
    * max. length: 20 chars
* user.avatar:
    * [a-z0-9_-/]
    * max. length: 255 chars
* pending.code:
    * [a-z0-9]
    * fixed length: 10 chars
* user.password:
    * SHA-1 sum
* user.country: ISO-3166-1
* user.sex: {'M', 'F'}
* {category, event}.repeat_interval: {0, 1, 2, 3, 4} (Never, Daily, Weekly, Monthly, Yearly)
* event.priority: {0, 1, 2, 3} (Low, Medium, High, Urgent)
* {category, event}.color, user.id, {initiator, followee}_id, bans.id,
  {category, pending}.user_id: [0, 2^16)
* bans.ip, category.category_id, event.{event_id, category_id},
  alarm.event_id: [0, 2^32)

Discard:
    * pass user input: \p{Ll} | \p{Lu} | \p{Nd} | \p{Sc} | \p{Sm} | \p{Pd} | \p{Pe} | \p{Po} | \p{Ps} | \p{Zs}
        * max. length: 30 chars
        * min. length: 6 chars


