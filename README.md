

Question
H1
The top of your error page named a file inside vendor. Say why that was not where your mistake was, and where the page showed you it actually was.

The top of the page showed a file in vendor, which is Laravel’s own code. That was only the place where Laravel noticed the problem and threw the error, because it could not find a method called withh(). My mistake was in my own controller. The exception trace showed it: the frame for app\Http\Controllers\GameController.php had the line Game::withh('genre') marked.


H2
You wrote one Log::info line with a context array. Name something it will tell you next month that the error page could not.

The error page only shows a problem while it is happening, and only to the person who sees it. The log line stays in laravel.log, so next month I can still see which game was saved, at what time, and with which id, for example Game saved {"id":9}. The error page could never tell me that, because a successful save does not show any error page at all.


H3
Your guard answers with 403 instead of redirecting back with a message. Say when each of the two is the better answer.

A 403 is better when the request should not be allowed at all, like deleting the last game in a genre, or when the request did not come from a normal form, so there is nobody to show a message to. A redirect with a message is better when it is a normal mistake from a real visitor, like a form with an empty field, because we can send them back to the same page and tell them what to fix.
