G1. Which column did you turn into a table, and why that one and not another?

I turned genre into a table. It comes from a fixed list (RPG, Shooter, Simulation, Action-Adventure), the same values repeat across many games, and a genre could have its own details later, like a description. year and is_multiplayer are just values, not things, so they stay as columns.

G2. What number did screenshot 6 show, and why exactly that number?

Screenshot 6 showed 8. My page had 7 games. One query got all the games, and then the page ran one more query per game to get its genre, because $game->genre->name was read for each row. That is 1 + 7 = 8.

If your screenshot still says 9, write this instead: “It showed 9. That is 1 query for the games, 7 queries for the genres (one per game), and 1 extra query from Genre::all() for the filter buttons.”

G3. Your belongsTo method is named in the singular. What would break if you made it plural?

Eloquent takes the method name and adds _id to find the foreign key column. If I named it genres(), it would look for a column called genres_id, which does not exist in my games table. The page would fail or show nothing for the genre, because it could not find the connection.
