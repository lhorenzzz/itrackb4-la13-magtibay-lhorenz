1. Which column did you make nullable, and why that one and not another?

I made year nullable. Sometimes the release year of a game is not known yet, for example if the game has not been released. The name, genre and platform are always needed to know what the game is, so I did not make them nullable.

2. Which step failed first for you, and what did the error say?

The first thing that failed was php artisan db:table with the migration file name. The error said Table [2026_10_14_093105_create_games_table] doesn't exist. I made two mistakes. I should have used the table name (games), not the migration file name. Also, I had not run php artisan migrate yet, so the migration was still “Pending” and the table did not exist.

3. You changed no Blade file in Part D, yet your pages still work. Why not?

The Blade file only shows the values it receives, like the game’s name and genre. It does not care where those values come from. Before, my controller got the games from a list I typed in the code. Now it gets them from the database table. I kept the same variable names ($games and $game), so the Blade file still found what it needed and showed the games the same way. Only the controller changed, so I did not need to edit the view.
