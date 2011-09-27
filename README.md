shoutcast Klasse für PHP
======

Eigenschaften
----------------
Keine um die ihr euch kümmern solltet ;)

Methoden
----------------

### __construct()
    object shoutcast::__construct( string $ip, int $port, string $pass )

Erstellt ein neues Shoutcast Objekt

## Parameter
    ip
        Die IP des Shoutcast Servers

    port
        Der Port auf dem der Shoutcast Server lauscht

    pass
        Das Passwort für das Admin-Interface des Shoutcast Servers
##

### getShoutcastData()
    array shoutcast::getShoutcastData()

Gibt die Daten aus der Shoutcast XML als Array zurück (Songhistory ausgenommen)

## Parameter
    nuttin
        to care 'bout

## Rückgabewert
    Die Daten aus der Shoutcast XML werden als Array zurückgegeben

### getShoutcastHistory()
    array shoutcast::getShoutcastHistory()

Liefert die Sonhistory des Shoucast Servers als Array

## Parameter
    nuttin
        to care 'bout

## Rückgabewert
    Songhistory des Shoutcast Servers als in einem Array

# 1
## 2
### 3
#### 4
