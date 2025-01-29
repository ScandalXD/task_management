Task Management Project

Temat projektu

Projekt zarządzania zadaniami – aplikacja webowa umożliwiająca użytkownikom dodawanie, edytowanie i usuwanie zadań. System wykorzystuje PHP, MySQL oraz Docker do zarządzania środowiskiem uruchomieniowym.

Uczestnicy projektu

Artur Pylypenko  – 44074

Imię Nazwisko 2 – Numer Indeksu 2

Imię Nazwisko 3 – Numer Indeksu 3

Instrukcja uruchomienia projektu

1. Wymagania wstępne

Zainstalowany Docker oraz Docker Compose

2. Uruchomienie projektu

 1. Sklonuj repozytorium:
   git clone https://github.com/ScandalXD/task_management.git
   cd task_management

 2. Uruchom kontenery:
       docker-compose up -d

 3. Dostęp do aplikacji: Otwórz przeglądarkę i wejdź na http://localhost:8080


3. Dodatkowe kroki (jeśli wymagane)

Jeśli występują błędy połączenia z bazą danych, sprawdź czy plik db.php używa poprawnej nazwy hosta (db zamiast localhost).

Jeśli port 3306 jest zajęty, zmień go w docker-compose.yml na 3307.

4. Zatrzymanie kontenerów

Jeśli chcesz zatrzymać projekt: docker-compose down