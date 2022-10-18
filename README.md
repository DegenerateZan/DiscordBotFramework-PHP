<img src="https://cdn.discordapp.com/attachments/997562428529328188/1027912099848007680/Framework_Logo.png" width="80"> # <b>DiscordBotFramework-PHP</b>

a <strike>Simple</strike> Discord Bot Framework with Crash handler made using PHP<br>
<br>Supperted (only) message intent<br>
not supported  - 1 . slash command (soon)<br>
## Getting Started

### Requirements

- PHP 7.4
	- i recommend PHP 8.0 as it will be the most stable and most performant.
	- x86 (32-bit) PHP requires [`ext-gmp` extension](https://www.php.net/manual/en/book.gmp.php) enabled for handling Permissions.
- Composer
- `ext-json`
- `ext-zlib`

## How to Install?
- make sure all the requirements above are met
- install the vendor using ``` composer require update ```<br>
- Copy and rename the .env.example to .env and fill the data<br>
- start the bot using  ``` php kernel serve ``` <b>(only on Linux)</b>
# Warning!
<b>in windows this bot DOES NOT SUPPORT Crash Handler feature and the execute kernel script <br>
and can only run independent without crash handler feature using </b> <br>``` php init.php ``` to run the bot <br>
Further detail about the library can be seen on the Official Discord-PHP GitHub https://github.com/discord-php/DiscordPHP
