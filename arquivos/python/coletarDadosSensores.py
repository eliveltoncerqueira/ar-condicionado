import sensorTemperatura
import sensorUmidade
import time

startTime = time.time()
n = 0
while True:
    n = n + 1
    sensorTemperatura.buscarTemperatura()
    sensorUmidade.buscarUmidade()
    print(n)
    time.sleep(6 - ((time.time() - startTime) % 1))
