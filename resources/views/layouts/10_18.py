# import turtle
# s = turtle.Screen()
# t = turtle.Turtle()
# t.speed(0)
# colors = []
# too = int(input("too= "))
# for x in range(too):
#     color = input("ungu= ")
#     colors.append(color)

# for color in colors:
#     t.fillcolor(color)
#     t.pencolor(color)
#     t.begin_fill()
#     t.circle(100)
#     t.end_fill()
#     t.up()
#     t.bk(100)
#     t.down()
# s.mainloop()

import turtle
s = turtle.Screen()
t = turtle.Turtle()
t.speed(0)
colors = ["red", "purple", "blue", "green","orange"]
for i in range(200):
    t.fd(i)
    t.pencolor(colors[i%5])
    t.pensize(i/10)
    t.right(59)
s.mainloop()