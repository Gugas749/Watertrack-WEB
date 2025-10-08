package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;


import java.util.Locale;

@Entity(tableName = "User_Infos")
public class UserInfosEntity {
    @PrimaryKey(autoGenerate = true)
    public long id;
    @ColumnInfo(name = "nome")
    public String nome;
    @ColumnInfo(name = "email")
    public String email;
    @ColumnInfo(name = "password")
    public String Password;
    @ColumnInfo(name = "morada")
    public String Morada;
    @ColumnInfo(name = "cargo")
    public int Cargo;
    @ColumnInfo(name = "theme")
    public String Theme;
    @ColumnInfo(name = "language")
    public String Language;

    public UserInfosEntity(String nome, String email, String Password, String Morada, int Cargo, String Theme, String Language) {
        this.nome = nome;
        this.email = email;
        this.Password = Password;
        this.Morada = Morada;
        this.Cargo = Cargo;
        this.Theme = Theme;
        this.Language = Language;
    }

    public void setInfos(String email){
        this.email = email;
    }
}