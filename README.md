# GridSimulator

Le programme permet aux utilisateurs de:

    - Construire un réseaux
    - Implémenter les différents type de centrale et de consommateur
    - Implémenter une simulation de météo
    - Implémenter une simulation des marchés
    - Implémenter un centre de contrôle permettant d'agir sur la production des centrales et sur la distribution des noeuds de distribution.
    - Obtenir le coût de production, les revenus et la quantité de CO2 produite à chaque seconde.
    - Obtenir des messages d'alerte: lignes surchargées, surproduction, sous-production, blackout, ...




# Installation
# Utilisation

## 1. Créer une nouvelle simulation / charger ancienne

Tout d'abord commencer par appuyer sur nouvelle simulation entrer un nom et un mot de passe avec minimum 
une majuscule un chiffre et minimum 6 caractères.

![1](https://user-images.githubusercontent.com/60986993/103455095-3f1f3480-4cea-11eb-8290-23461b87e070.PNG)


## 2. Construire un nouveau circuit électrique


### 2.1 Ouvrer la barre du haut et sélectionner editor

![2](https://user-images.githubusercontent.com/60986993/103455378-cf5e7900-4cec-11eb-8ec3-8b21b8db6082.PNG)

### 2.2 Créer les différents type producteurs du circuit 
- Sélectionner le type de producteur
- Entrer le nom
- Entrer les caractéristiques (Cout , CO2, Puissance max)

![3](https://user-images.githubusercontent.com/60986993/103455783-392c5200-4cf0-11eb-99b4-dde657f84760.PNG)
### 2.3 Créer les différents type consommateurs du circuit 
- Sélectionner le type de consommateur
- Entrer le nom
- Entrer les caractéristiques (Cout , Puissance max)

![4](https://user-images.githubusercontent.com/60986993/103455829-bc4da800-4cf0-11eb-99bf-f73943cc181d.PNG)

### 2.4 Commencer a créer votre circuit 
Ajouter progressivement les différents producteurs et consommateurs crée au par avant pour constituer le circuit électrique.

![5](https://user-images.githubusercontent.com/60986993/103455920-8a891100-4cf1-11eb-9024-6979a090db72.PNG)


## 2. Lancement simulation

Une fois satisfait de votre circuit retourner dans l'onglet Dashboard du menu principale et appuyer sur le bouton play a droite de l'écran.
![6](https://user-images.githubusercontent.com/60986993/103456038-a640e700-4cf2-11eb-9523-366326653590.PNG)

## 3. Analyse des résultats 

Vous avez plusieurs onglet disponibles contenant différentes informations 
### 3.1 Onglet Dashboard 
La partie Essentials qui résume toute les infos et affiche les log d'erreur.
![1 1](https://user-images.githubusercontent.com/60986993/103456259-c8d3ff80-4cf4-11eb-9e3e-e49481889cce.PNG)
La Node grid qui représente le système 
![1 2](https://user-images.githubusercontent.com/60986993/103456263-ca052c80-4cf4-11eb-9059-a88f939d8ca9.PNG)
La puissance électrique produite et consommée 
![1 3](https://user-images.githubusercontent.com/60986993/103456267-cb365980-4cf4-11eb-875b-7d10537213c9.PNG)
Les émissions de CO2
![1 4](https://user-images.githubusercontent.com/60986993/103456269-cc678680-4cf4-11eb-95e6-a7fad0116b27.PNG)
L'argent dépensé pas le circuit 
![1 5](https://user-images.githubusercontent.com/60986993/103456270-cd98b380-4cf4-11eb-8d34-1426b52eaff9.PNG)

### 3.2 Onglet Production
Affiche les producteurs et leurs émission de CO2

![2 1](https://user-images.githubusercontent.com/60986993/103456335-60395280-4cf5-11eb-84cf-fcc079432ec7.PNG)

### 3.3 Onglet Consommation
Affiche les producteurs et leurs émission de CO2
![3 1](https://user-images.githubusercontent.com/60986993/103456372-ac849280-4cf5-11eb-8d3d-081f1eb80c6a.PNG)

### 3.4 Onglet Weathers
Affiche toute les données climatiques en fonction de l'heure.

![4 1](https://user-images.githubusercontent.com/60986993/103456386-d76ee680-4cf5-11eb-8850-d1cc2aa7c6ea.PNG)




## UML diagrams

![Simu](https://user-images.githubusercontent.com/60986993/103457673-88c74980-4d01-11eb-9dfd-0bca800bc591.png)


You can render UML diagrams using [Mermaid](https://mermaidjs.github.io/). For example, this will produce a sequence diagram:

sequence diagram:

```mermaid
sequenceDiagram
Alice ->> Bob: Hello Bob, how are you?
Bob-->>John: How about you John?
Bob--x Alice: I am good thanks!
Bob-x John: I am good thanks!
Note right of John: Bob thinks a long<br/>long time, so long<br/>that the text does<br/>not fit on a row.

Bob-->Alice: Checking with John...
Alice->John: Yes... John, how are you?
```
