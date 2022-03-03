# API-2022
Blogul este compus din categorii si articole.
Categoriile se vor insera in bază prin seed.

Endpoint-uri pentru utilizatorii logați:
- Create Article: id-ul categoriei, titlu și descriere sunt obligatorii.
-![image](https://user-images.githubusercontent.com/61292431/156535323-44f05e69-4be9-4515-8c00-9a869758a0a8.png)
- Edit Article: id-ul categoriei, titlu și descriere sunt obligatorii.
- ![image](https://user-images.githubusercontent.com/61292431/156535077-aa0983cd-cbad-4198-9816-0a4fa6b2a9cc.png)
- Delete Article
- ![image](https://user-images.githubusercontent.com/61292431/156534797-ccabf34a-3619-4efc-a4a3-1352a43fa0d6.png)
- Vote: up sau down
- ![image](https://user-images.githubusercontent.com/61292431/156534737-30b84f2b-de52-4e08-861e-e6762f435189.png)
- My articles
-![image](https://user-images.githubusercontent.com/61292431/156534597-18524ab3-46e8-4eb5-aa77-3f1f40f03090.png)


Endpoint-uri pentru oaspeți:
- All articles: Toate articolele sortate după data creerii descrescător. Cu posibilitatea de a filtra după id-ul categoriei sau cuvânt cheie care se conține în titlu sau descriere. În raspuns să se conțină și numele categoriei. + Paginare.
- ![image](https://user-images.githubusercontent.com/61292431/156534061-e55b9ce5-0d8f-4f29-86df-2b7e9a87d8f2.png)
- Top categories: Maxim 5 categorii sortate dupa reiting descrescator și care au minim două articole + numărul total de articole din categorie.
- ![image](https://user-images.githubusercontent.com/61292431/156549379-3dcedde6-45be-40ed-8467-ebc5a25a14fd.png)


