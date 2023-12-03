## PHP Socket Client-Server Application
### Përshkrimi:
Ky projekt është një aplikacion klient-server në PHP që përdor soketa për komunikim. Aplikacioni ka dy pjesë kryesore: serverin (Server.php) dhe klientin (Client.php). Aplikacioni mundëson shkëmbimin e komandave dhe të dhënave midis klientit dhe serverit përmes soketave.
### Përdorimi
#### Server (Server.php)
##### Krijimi i Serverit:
Krijojmë një server përmes socket_create.
Lidhnim serverin në një adresë dhe port specifike duke përdorur socket_bind.

##### Dëgjimi për Klientë:
Përdornim socket_listen për të dëgjuar për lidhje të reja.
Presim për lidhje të reja dhe krijojmë një soket të ri për secilin klient me socket_accept.

##### Komunikimi me Klientët:
Përdorim socket_read për të lexuar komandat e klientit.
Implementojmë funksionalitete të ndryshme bazuar në komandat e pranuara.
