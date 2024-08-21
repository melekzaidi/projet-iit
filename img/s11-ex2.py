from random import randint
from numpy import array
t=array([str]*14)
v=array([str]*14)
def saisir():
    global n
    b= False
    while b==False:
        n=int(input("n="))
        b=(2<=n<=14) and n %2==0

def aleatoire (n):
    ch=""
    for i in range(n) :
        ch= ch + str (randint(1, 9 ))
    return ch

def remplirt(t,n):
    for i in range(n):
       t[i]=aleatoire(n)

def remplirv(t,v,n):
    for i in range(n):
        ch=t[i]
        car=""
        for j in range(0,len(ch),2):
            car=car+(chr(int(ch[j]+ch[j+1])))
        v[i]=car

def affiche(t,n):
    for i in range(n):
        print(t[i])
        
#pp
saisir()
remplirt(t,n)
remplirv(t,v,n)
affiche(t,n)
affiche(v,n)

