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

#### Klienti (Client.php)
##### Krijimi i Klientit:
Krijonjmë një klient përmes socket_create.
Lidhemi me serverin përmes socket_connect.

##### Dërgimi i Komandave:
Përdorim socket_write për të dërguar komandat nga klienti te serveri.

#####Pranimi i Përgjigjeve:
Përdorim socket_read për të pranuar përgjigjet nga serveri për secilën komandë.

#####Mbyllja e Lidhjes:
Përdorim komandën "CLOSE" për të mbyllur lidhjen me serverin.

#### Komandat e Mundshme
- "GET": Shfaq një listë me komandat e disponueshme në server.
- "VIEW_FILES": Shfaq strukturën e skedarëve në server.
- "OPEN <file_name>": Shfaq përmbajtjen e një skedari.
- "WRITE <file_name> <content>": Shkruaj përmbajtjen e një skedari (kërkon privilegji admin).
- "DELETE <file_name>": Fshij një skedar (kërkon privilegji admin).
- "CREATE <file_name>": Krijo një skedar të ri (kërkon privilegji admin).
- "REQ_ADMIN": Kërko privilegji admin nga serveri.

Projekti u punua nga:
- Elonita Krasniqi
- Elvira Metaj
- Endi Rashica
- Erblin Kelmendi
