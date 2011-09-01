* User nicks, names, category and event names: 
    * \p{Ll} | \p{Lu} | \p{Nd} | U+002D | U+005F
    * min. length: 1 char
    * max. length: 20 chars
* Dates: timestamps
* User, Category and Event Description: 
    * \p{Ll} | \p{Lu} | \p{Nd} | \p{Po} | \p{Ps} | \p{Pe} | \p{Sm} | \p{Pd}
    * max. length: 100
* User emails: 
    * \p{Ll} | \p{Nd} | U+0040 | U+002E
    * min. length: 5 chars
    * max. length: 255 chars
* Security question and answer:
    * \p{Ll} | \p{Lu} | \p{Po} | \p{Nd}
    * min. length: 8 chars
    * max. length: 255 chars
* Private, exception: {0, 1} (FALSE, TRUE)
* Timezones:
    * \p{Ll} \p{Lu} | U+002F
    * max. length: 27 chars
* City:
    * \p{Lu} | \p{Ll}
    * max. length: 30 chars
* Phone: 
    * \p{Nd} | \p{Ps} | \p{Pe} | \p{Zs} | U+002B
    * max. length: 20 chars
* Avatar: 
    * \p{Ll} | \p{Lu} | \p{Nd} | U+002F
    * max. length: 255 chars
* Activation code:
    * \p{Ll} | \p{Nd}
    * fixed length: 10 chars
* Password:
    * user input: \p{Ll} | \p{Lu} | \p{Nd} | \p{Sc} | \p{Sm} | \p{Pd} | \p{Pe} | \p{Po} | \p{Ps} | \p{Zs}
        * max. length: 30 chars
        * min. length: 6 chars
    * SHA-1 encrypted string, fixed length: 40 chars
* Country: ISO-3166-1
* Sex: {'M', 'F'}
* Repeat intervals: {0, 1, 2, 3, 4} (Never, Daily, Weekly, Monthly, Yearly)
* Priority: {0, 1, 2, 3} (Low, Medium, High, Urgent)
* Color, User and Initiator ID: [0, 2^16)
* IP, Category and Event ID: [0, 2^32)

