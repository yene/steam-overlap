# Steam Overlap
Show what steam games everybody shares

# start server
php -S 0.0.0.0:8000

# test
http://80.218.222.83/?ids=76561197964515697,76561197994273896,76561198005110125
http://steamcommunity.com/profiles/76561197964515697?xml=1 => http://steamcommunity.com/id/yene/?xml=1&l=english


# Todo
* lookup the games for a user
* prevent cross domain requests
* lookup the user id for user name
* lookup the multiplayer games only
* sort by most games you have in common
* add steam powered to the footer http://steamcommunity.com/dev

# flow
* login first -> select 3 friends from friends list
* or add 4 person manually

# Notes
http://steamidfinder.com/
* getting all games http://api.steampowered.com/ISteamApps/GetAppList/v0001/
* https://developer.valvesoftware.com/wiki/Steam_Web_API#GetOwnedGames_.28v0001.29
* http://stackoverflow.com/questions/19247887/get-steamid-by-user-nickname
* list always free coop games like TF2 and alien
* list of all multiplayer games
* list of all coop games
* http://media.steampowered.com/steamcommunity/public/images/apps/{appid}/{hash}.jpg
http://steamcommunity.com/search/SearchCommunityAjax?text=octob&filter=users&sessionid=45a4f468a6947f2172c67540&steamid_user=false

# design
* für jeden spieler ne spalte, darin die logos von oben nach unten aufliste, sortiert nach wie viele spieler es haben, wenn ein spieler das spiel nicht hat muss es ausgegraut sein.
* title tag von bild soll spiel name
* link auf bild soll zum steam shop führen
* man soll die möglichkeit haben neue spalte hinzuzufügen oder zu löschen
* checkbox zum multiplayer spiele filtern
* checkbox zum filtern von popular free games tf2, dota 2
