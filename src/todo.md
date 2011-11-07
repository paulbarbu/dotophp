do not add a user twice in the pending table when resetting passwords

2011-10-22 12:23:38	+flavius	daca pui folding markers face vim treaba
2011-10-22 12:23:57	+flavius	vezi ca mai trebuie ceva setari si la sfarsitul fiecarui fisier
2011-10-22 12:24:09	+flavius	ai exemplu prin phpmeta

doxygen: document dotophp/bin also

mysql_real_escape_string()

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

 +misterjinx | tot la partea de înregistrare, dacă nu-ți reușește trimiterea mail-ului de activare tu ștergi userul abia creat  ?        │
22:46:39     paullik | da                                                                                                                        │
22:47:00     paullik | m-am gandit asa: sa nu am leftovers                                                                                       │
22:47:48 +misterjinx | nu e în regulă asta, adică eu ca user aș fi supărat să se întâmple asta                                                   │
22:48:20 +misterjinx | propunerea mea ar fi să nu ștergi respectivul user ci să faci o funcționalitate de tipul „nu ai primit mail-ul de         │
                     | actiovare?”                                                                                                               │
22:48:35 +misterjinx | unde userul să intre și să-și bage adresa de email și să i se retirmită acest mail                                        │
22:48:44 +misterjinx | *retrimită                                                                                                                │
22:49:09     paullik | da, suna bine

on not recovering fields show all errors at once
