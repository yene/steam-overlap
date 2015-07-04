# Steam Overlap
Show what steam games everybody shares

# Todo
* clean readme
* refresh static lists in the html
* Steamoverlap, click on used button replace user
* make custom mouseover for the friends list -> on mouseover show username (http://jsfiddle.net/tDQWN/)
* only accept requests from same domain
* click on the exisiting friend/user should replace his games list
* clear button on top of the user (X)
* add filter for singleplayer, free games
* if friend is just one word try the profile param
* load friends only when first url changes
* add a filter to friends list
* add spinner for ajax
* app breaks when adding private profile, like 76561197974899907
* are private profiles visible if you login through steam oauth?
* when profile is private show warning

# test
http://steamcommunity.com/profiles/76561197964515697?xml=1 => http://steamcommunity.com/id/yene/?xml=1&l=english

# todos and stuff and later todos
* search for players like friend finder
* sort by count and then alphabetically -> rewrite?? :D
* bash script that deletes old files
* add UI to filter for minimum playtime
* todo add friend finder
* todo playtime is copied over
* increase limit of 4 columns to 10
* search for user
  * http://steamcommunity.com/search/
  * browser requires session
---
* lookup the games for a user
* prevent cross domain requests
* lookup the user id for user name
* lookup the multiplayer games only
* sort by most games you have in common

# flow
* login first -> select 3 friends from friends list
* or add 4 person manually

# Notes
http://steamidfinder.com/
* http://stackoverflow.com/questions/19247887/get-steamid-by-user-nickname
* list always free coop games like TF2 and alien
* list of all multiplayer games
* list of all coop games
* http://media.steampowered.com/steamcommunity/public/images/apps/{appid}/{hash}.jpg
http://steamcommunity.com/search/SearchCommunityAjax?text=octob&filter=users&sessionid=45a4f468a6947f2172c67540&steamid_user=false

# steam api
* API DOC: https://developer.valvesoftware.com/wiki/Steam_Web_API
* All games: http://api.steampowered.com/ISteamApps/GetAppList/v0001/
