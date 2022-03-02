# API-2022
Blogul este compus din categorii si articole.
Categoriile se vor insera in bază prin seed.

Endpoint-uri pentru utilizatorii logați:
- Create Article: id-ul categoriei, titlu și descriere sunt obligatorii.
- Edit Article: id-ul categoriei, titlu și descriere sunt obligatorii.
- Delete Article
- Vote: up sau down
- My articles

Endpoint-uri pentru oaspeți:
- All articles: Toate articolele sortate după data creerii descrescător. Cu posibilitatea de a filtra după id-ul categoriei sau cuvânt cheie care se conține în titlu sau descriere. În raspuns să se conțină și numele categoriei. + Paginare.
- Top categories: Maxim 5 categorii sortate dupa reiting descrescator și care au minim două articole + numărul total de articole din categorie.
