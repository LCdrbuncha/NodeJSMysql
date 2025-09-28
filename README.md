# Prerequisites
## สรุปเครื่องมือ/สิ่งที่ต้องเตรียม (Prerequisites)

- Node.js (แนะนำ v18+). ตรวจสอบด้วย node -v. 
- npm (มาพร้อม Node)
- (เลือก) MongoDB local หรือ MongoDB Atlas — ในตัวอย่างจะใช้ MongoDB + Mongoose เพื่อทำ Model/CRUD. 
- editor เช่น VS Code, และเครื่องมือทดสอบ API (curl / HTTPie / Postman)



## ติดตั้งเครื่องมือ
1.Node.js (LTS) บน Docker
2. npm (มาพร้อม Node.js)
3. VS Code หรือ Text Editor


### 1. Install Docker Desktop on Windows
    1.1 ดาวน์โหลด และติดตั้ง เลือก Docker Desktop for Windows - x86_64 จาก 
        https://docs.docker.com/desktop/setup/install/windows-install/

    1.2 ตรวจสอบ Docker
        - wsl --version
        - docker --version
        - docker run hello-world
        
    1.3 คำสั่ง Docker พื้นฐาน
        📥 จัดการ Image
            # ดึง image จาก Docker Hub : docker pull nginx:latest
            # แสดง image ที่มีอยู่ในเครื่อง : docker images
            # ลบ image : docker rmi nginx:latest

        📦 จัดการ Container
            # รัน container (จาก image nginx) : docker run -d --name webserver -p 8080:80 nginx:latest
            # ดู container ที่กำลังรันอยู่ : docker ps
            # ดู container ทั้งหมด (รวมที่หยุดแล้ว) : docker ps -a
            # เข้าไปใน container แบบ interactive : docker exec -it webserver bash
            # หยุด container : docker stop webserver
            # ลบ container : docker rm webserver

    1.4 ติดตั้ง Server www
        - docker run -d -p 8080:80 --name our-web-server nginx
        - ตรวจสอบ Service : 
            - เปิด URL : Localhost:8080
            - Service ที่เปิดอยู่ : docker ps
            - Service ทั้งหมด : docker ps -a
            
    1.5 เปิด/ปิด Service
            - ปิด : docker stop our-web-server   
            - เปิด : docker start our-web-server
---------------------------------------------------------------------------------------------------------
           
   ### 2. เตรียม Back End
       2.1 ตรวจสอบว่าเปิด Docker Desktop
       2.2 ตรวจสอบว่าปิด our-web-server (ps, stop)
       2.3 สร้าง Folder จัดเก็บ Project (C:\Users\xxxx\Documents\NodeJS\demoproject)  # แทน xxxx ด้วย user ของคุณ
       2.4 สำเนา docker_nginx_mysql_phpmyadmin - demo ลงใน 2.3
    
            
