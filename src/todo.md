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

steal my own cookie

recursive dependency function - think about circular deps
check constants for having the same value

design the ERD

delete the sessions upon expiring

modify hasEvents query using JOIN

show the events and categories as formatted HTML lists
show all event errors at once
make a little quick-add syntax(start, due, color, priority, repeat)

tooltips for explaining things

on autologin after sess_set_cookie_params() check on the client if the initial
30 days cookie wasn't overwritten by a one-time-only cookie

maybe after login because of the $_GET['show'] remaining 'login'(considering
that i'm redirected) I will have problems, please investigate this early
