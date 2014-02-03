db-city-to-county-sweden
---

En MySQL-databas som mappar städer till län inom Sverige.

Databasen är tagen från:
http://www.phpportalen.net/viewtopic.php?t=49659  
Felaktiga kolumner har rensats bort. Förbättringar på databasen via pull requests mottages.

En hjälpklass i PHP ingår.

#### Användning av hjälpklassen.

Klassen tar fyra argument när man skapar den, som motsvarar PDO-argumenten $dsn, $username, $password, $driver_options  
Klassen exponerar funktionen city_to_county(). Denna tar två argument, en stad och ett default-värde som returneras om staden inte kunde mappas till ett län.

##### Exempel
```php
include('CityStateMapper.class.php');
$mapper = new CityStateMapper('mysql:host=localhost;dbname=city_state_sweden;charset=utf8', 'username', 'password');

echo $mapper->city_to_county('Göteborg');
```

Resultat
```
Västra Götalands Län
```

##### Exempel med stad som inte existerar

```php
echo $mapper->city_to_county('Morotsstaden', 'Län hittades ej');
```

Resultat
```
Län hittades ej
```
