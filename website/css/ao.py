a=[0,0,0,0,0,0]
b=[0,0,0,0,0,0]
m=0
count=1
ary=[]
try:
	while True and count<7:
    		text=input()
    		if not text:
    			break
    		else:
    			ary.append(text) 
    			count=count+1
    for x1 in ary:
    	x=x1.split('(',1)[0]
    	if len(x)==4:
    		x=x.lower()
    		if x[:4]=="acov" and a[0]==0:
    			a[0]=1
    			m=m+0.5
    		elif x[:4]=="bcov" and a[1]==0:
    			a[1]=1
    			m=m+0.5
    		elif x[:4]=="ccov" and a[2]==0:
    			a[2]=1
    			m=m+0.5
    		elif x[:4]=="dcov" and a[3]==0:
    			a[3]=1
    			m=m+0.5
    		elif x[:4]=="ecov" and a[4]==0:
    			a[4]=1
    			m=m+0.5
    		elif x[:4]=="fcov" and a[5]==0:
    			a[5]=1
    			m=m+0.5
    
    	val = x1.split('(', 1)[1].split(')')[0]
    
    	if "(" in x1:
    		if len(val)==1:
                	val=val.upper()
    			if val=='A' and b[0]==0:
    				b[0]=1
    				m+=0.5
    			elif val=="B" and b[1]==0:
    				b[1]=1
    				m=m+0.5
    			elif val=='C' and b[2]==0:
    				b[2]=1
    				m+=0.5
    			elif val=="D" and b[3]==0:
    				b[3]=1
    				m=m+0.5
    			elif val=='E' and b[4]==0:
    				b[4]=1
    				m+=0.5
    			elif val=="F" and b[5]==0:
    				b[5]=1
    				m=m+0.5
	print(str(m)+" out of 6")
except:
    pass


