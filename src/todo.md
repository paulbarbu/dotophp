mysqli_real_escape_string()

 starlays | paullik: ca sa poata php sa trimita e-mail trebuie sa imi configurez ceva anume?                                          │
22:25:28    starlays | daca ma poate ajuta cineva as fi recunosctor, ce recomandati mta sau mail server dedicat pentru a fi folosit cu php?      │
22:34:35 +misterjinx | încearcă să instalezi sendmail și pe urmă modifică în php.ini caleacătre sendmail                                         │
22:35:21    starlays | am citit ca sendmail are niste gaurele de securitate                                                                      │
22:35:48 +misterjinx | asta era varianta cea mai simplă                                                                                          │
22:36:03 +misterjinx | dacă ar fi să-ți recomand un server de smtp atunci ți-aș recomanda postfix                                                │
22:36:03    starlays | misterjinx: ook, mersi                                                                                                    │
22:36:22    starlays | parca as tinde catre un mta pentru teste
starlays | am gasit pe wiki cica ar fi ssmtp pentru arch                                                                             │ flavius  
22:36:56 +misterjinx | după ce-l instalezi încearcă un simplu echo "test mail" | sendmail mailultău@domain.com

when the view content is too large an alignment problem occurs

steal my own cookie

recursive dependency function - think about circular deps
check constants for having the same value

do not show login page to already logged in users(done)
same with log out(done)

redirect users after login to upcoming or to event modules(done)

design the ERD

think about user_id in event table

look over the conditions in build_menu_from_modules, and make recover module to
show up in menu just for not logged in users

replace getStrByState()

if not logged in show login in menu

maybe after login because of the $_GET['show'] remaining 'login'(considering
that i'm redirected) I will have problems, please investigate this early
