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

---

##### Disclaimer
This may not be the best code ever written. This was just a quick and dirty project.
If you want to know something about the EFA-Api, don't ask me, I know nothing.
But you can take a look here: http://data.linz.gv.at/katalog/linz_ag/linz_ag_linien/fahrplan/LINZ_LINIEN_Schnittstelle_EFA_V1.pdf

Inspired by 
https://github.com/TheNewCivilian/AVV_EFA_Timetable 