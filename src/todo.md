2011-10-22 12:23:38	+flavius	daca pui folding markers face vim treaba
2011-10-22 12:23:57	+flavius	vezi ca mai trebuie ceva setari si la sfarsitul fiecarui fisier
2011-10-22 12:24:09	+flavius	ai exemplu prin phpmeta

doxygen: check the error/warnings

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

check cron errors(expired.php)

split the auth module in login and logout, this change is needed because the
module array is set before any session and processing is made, so the app cannot
determine if the user is logged in or not, getting this information before
any processing is made(ie: including autologin.php on index.php) is just
wrong(the index links the view and the controller, doesn't makes processing so
the model cannot include a file related to the controller, besides this would
cause another problem, having to duplicate app_path() from yaCMS, because the
autologin script needs it and it is not available in the early phase)
and problem causing(double checking for cookies - affects speed)
