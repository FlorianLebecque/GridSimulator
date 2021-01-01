import time
from Database import Db 

class s_stime:
    def __init__(self):
        pass

    def init_time(self,last_time):
        if (last_time is not None):
            start_sim = time.time() - last_time

        else :
            start_sim = time.time()
        
        return start_sim,time.time()-1

    def diff_time(self,temp_time):
        return time.time()-temp_time