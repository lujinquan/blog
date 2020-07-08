### 1、在python语言中，对象是通过引用传递的。
```
在赋值时，不管这个对象是新创建的，还是一个已经存在的，都是将该对象的引用（并不是值）赋值给变量。如： x=1  1这个整形对象被创建，然后将这个对象的引用赋值给x这个变量
```

### 2、多元赋值，其实就是元组赋值。
```
x,y,z=1,2,'string'  等价于 (x,y,z)=(1,2,'string')

# 利用多元赋值实现的两个变量的值交换

&gt;&gt;&gt; x, y = 1, 2
&gt;&gt;&gt; x
1
&gt;&gt;&gt; y
2
&gt;&gt;&gt; x, y = y, x
&gt;&gt;&gt; x
2
&gt;&gt;&gt; y
1
```

### 3、编写模块。
```
# 1，起始行
# -*- coding: cp936 -*-

# 2，模块文档
&quot;&quot;&quot;This is a test module again&quot;&quot;&quot;

# 3，模块导入
import sys
import os

# 4，变量定义
debug=True

# 5，类定义语句
class FooClass(object):
	&quot;&quot;&quot;FooClass&quot;&quot;&quot;
	flag=1
	def foo(self):
		print &quot;FooClass.foo() is invoked，&quot;+str(self.flag)

# 6，函数定义语句
def test():
	&quot;&quot;&quot;test function&quot;&quot;&quot;
	foo=FooClass()

	if debug:
		print 'run test()'
		foo.foo()
		print foo.flag

# 7，主程序
if __name__ == '__main__':
	test()
	print &quot;what are these?&quot;
```

### 4、时刻记住一个事实。
```
那就是所有的模块都有能力来执行代码，最高级别的python语句，也就是说，那些没有缩进的代码行在模块被导入时就会执行，不管是不是真的需要执行。
由于有这样一个“特性”，比较安全的写代码的方式就是除了那些真正需要执行的代码以外，几乎所有的功能代码都在函数当中。再说一遍，通常只有主程序模块中的顶级可执行代码，所有其他被导入的模块值应该有很少的顶级执行代码，所有的功能代码都应该封装在函数或类当中。
```

### 5、动态类型。
```
变量赋值时，解释器会根据语法和右侧的操作来决定新对象的类型。
在对象创建后，一个该对象的引用会被赋值给左侧的变量。
```

### 6、量在内存中是通过引用计数来跟踪管理的。
```
一个对象增加新的引用：对象被创建、对象的别名被创建、作为参数传递给函数方法或类、成为容器对象中的一个元素。
一个对象减少引用：变量赋值给另外一个对象、del显示删除一个变量、引用离开了它的作用范围、对象被从一个窗口对象中移除、窗口对象本身被销毁。
```

### 7、异常处理。
```
#try-except-else语句，else 子局在try 代码块运行无误时执行
#异常处理最适用的场合，是在没有合适的函数处理异常状况的时候
try:
	fobj=open(fname,'r')
except IOError,e:
	print &quot;file open error：&quot;,e
else:
	for eachLine in fobj:
		print eachLine,
	fobj.close()
```

### 8、所有的Python 对像都拥有三个特性。
```
身份、类型、值，这三个特性在对象创建的时候就被赋值，除了值之外，其他两个特性都是只读的
```

### 9、布尔值。
```
每个对象天生具有布尔 True 或 False 值，空对象，值为零的任何数字或者Null对象 None 的布尔值都是 False 
```

### 10、对象身份比较。
```
&gt;&gt;&gt; x=1.0
&gt;&gt;&gt; y=1.0
&gt;&gt;&gt; x is y
False
&gt;&gt;&gt; x is not y
True
&gt;&gt;&gt; id(x)
19094432
&gt;&gt;&gt; id(y)
19094416
# 比较两个凉凉是否指向同一个对象，但是整数和字符串有缓存机制，有可能指向同一个对象
```

### 11、cmp()
```
内建函数cmp()用于比较两个对象obj1 和 obj2，如果obj1 小于 obj2，则返回一个负整数，如果obj1 大于 obj2，则返回一个正整数，如果 obj1 等于 obj2，则返回0。它的行为非常类似于C 语言的strcmp()函数。比较是在对象之间进行的，不管是标准类型对象还是用户自定义对象。如果是用户自定义对象，cmp()会调用该类的特殊方法__cmp__()
```

### 12、str()和repr()。
```
str()函数得到的字符串可读性好，而repr()函数得到的字符串通常可以用来重新获得该对象，通常情况下 obj == eval(repr(obj)) 这个等式是成立的。
str()得到的字符串对人比较友好，而repr()得到的字符串对python比较友好
```

### 13、isinstance()和type()，主要体现的是代码的优化。
```
from types import *

def displayNumType0(num) :
	print num,'is',
	if type(num) is IntType :
		print 'an integer'
	elif type(num) is LongType :
		print 'a long'
	elif type(num) is FloatType :
		print 'a float'
	elif type(num) is ComlexType :
		print 'a complex'
	else :
	 	print 'not a number at all !!!'

def displayNumType1(num):
	print num, 'is',
	if(isinstance(num,(int,long,float,complex))):
		print 'a number of type：', type(num).__name__
	else:
		print 'not a number at all !!!'
```

### 14、标准类型的分类。
```
（1）存储类型
	标量/原子类型：数值（所以的数值类型），字符串（全部是文字）
	容量类型： 列表、元组、字典
（2）更新类型
	可变类型： 列表、字典
	不可变类型： 数字、字符串、元组
（3）访问类型
	根据访问我们存储的数据的方式对数据类型进行分类，在访问模型中共有三种访问方式：直接存取，顺序，和映射。
	直接访问： 数字
	顺序访问： 字符串、列表、元组
	映射访问： 字典

	映射类型类似序列的索引属性，不过它的索引并不使用顺序的数字偏移量取值，它的元素无序存放，通过一个唯一的key来访问，这就是映射类型，它容纳的是哈希键-值对的集合。

汇总：

数据类型		存储模型		更新模型		访问模型
数字			Scalar		不可更改		直接访问
字符串		Scalar		不可更改		顺序访问
列表			Container	可更改		顺序访问
元组			Container 	不可更改		顺序访问
字典			Container	可更改		映射访问
```

### 15、不同数据类型之间的运算。
```
在运算之前，要将两个操作数转换为同一数据类型，数字强制类型转换原则是整数转换为浮点数，非复数转换为复数
```

### 16、python除法。
```
# （1）传统除法，若操作数是整数，则进行取整操作，若操作数是浮点数，则执行真正的除法
&gt;&gt;&gt; 1/2
0
&gt;&gt;&gt; 1.0/2
0.5

# （2）真正的除法，未来的除法，不管操作数是什么类型，都要进行真正的除法运算
&gt;&gt;&gt; from __future__ import division
&gt;&gt;&gt; 1/2
0.5
&gt;&gt;&gt; 1.0/2.0
0.5

# （3）地板除，不管操作数是什么数据类型，都进行取整操作
&gt;&gt;&gt; 1//2
0
&gt;&gt;&gt; 1.0//2
0.0
```