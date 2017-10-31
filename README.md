AVV Monitor
===

This displays a little webpage that shows all upcoming public transport connections at a given station in Augsburg/Germany. 

It will default to "Park + Ride Haunstetten West", but you can select other stations by simpy adding
```
?station=<searchstring>
```
to the url.

Installation
---

This project uses NPM to manage the dependencies for jQuery and Bootstrap.
Therefore, perform 
```
npm install
```

and you are good to go.
You can re-compile Bootstrap and SASS by typing

```
npm run sass
```

so you can e.g. edit the color variables of Bootstrap. Look at /assets/css/main.scss for an example.


#### Meeeh node/npm sucks/I don't want to/cannot install it.
Doesn't matter. Simply integrate jQuery yourself in the index.php

The SASS is already compiled, if you want to re-compile it,
feel free to use your own preferred toolchain. 