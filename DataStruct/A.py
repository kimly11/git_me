fruits = ["Apple", "Banana", "Cherry", "Durian"]

sorted_fruits_az = sorted(fruits)
print("Sorted A-Z:", sorted_fruits_az)

sorted_fruits_za = sorted(fruits, reverse=True)
print("Sorted Z-A:", sorted_fruits_za)

sorted_fruits_length = sorted(fruits, key=len)
print("Sorted by length:", sorted_fruits_length)
