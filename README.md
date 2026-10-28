
#
Question
G1
Route model binding needs two things to be true. Name both, and say what happens when only one of them is.
- Route model binding needs two things: the route parameter name must match the controller variable name ({game} and $game), and the variable must be type-hinted with the Eloquent model (Game $game). If the name matches but there is no type-hint, Laravel gives you the plain ID, not a model. If the type-hint is there but the names don’t match, Laravel can’t link the ID, so you get an empty Game object instead of the record.


G2
Your Delete link gave a 404 even though the address was correct. Explain why.
- The address /games/{id} was correct, but the link gave a 404 because no game exists with ID 99999. Route model binding looks for the record, finds nothing, and Laravel returns 404 automatically. With a real ID, the link just opens the show page, because a link sends GET, not DELETE.

G3
old() takes a second argument on your edit form. What would break if you left it out, and what would break if you used only it?
- In old('title', $game->title), the second argument is the default value, the saved data from the database. If you leave it out, the edit form opens with empty fields because there is nothing to show. If you use only it (just $game->title with no old()), the form works on first load, but after a validation error it goes back to the database value and the user’s new input is lost.
