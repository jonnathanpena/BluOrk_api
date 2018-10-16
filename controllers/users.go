package controllers

import (
	"net/http"
	"fmt"
	_ "github.com/go-sql-driver/mysql"
    "database/sql"
)

func GetAllUsers(w http.ResponseWriter, r *http.Request) {
	db, err := sql.Open("mysql", "root:@/bluork?charset=utf8")
	checkErr(err)
	
	rows, err := db.Query("SELECT * FROM `bo_users`")
    checkErr(err)

    for rows.Next() {
        var id_users int
        var firstName_users string
        var lastName_users string
        var email_users string
        var password_users string
        var createAt_users string
        var updateAt_users string
        err = rows.Scan(&id_users, &firstName_users, &lastName_users, &email_users, &password_users, &createAt_users, &updateAt_users)
        checkErr(err)
        fmt.Println(id_users)
        fmt.Println(firstName_users)
        fmt.Println(lastName_users)
        fmt.Println(email_users)
        fmt.Println(password_users)
        fmt.Println(createAt_users)
        fmt.Println(updateAt_users)
    }
}

func checkErr(err error) {
	if err != nil {
		panic(err)
	}
}