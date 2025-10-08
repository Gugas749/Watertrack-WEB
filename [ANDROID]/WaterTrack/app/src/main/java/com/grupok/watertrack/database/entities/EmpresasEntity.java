package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "Empresas")
public class EmpresasEntity {

    @PrimaryKey(autoGenerate = true)
    public long id;

    @ColumnInfo(name = "nome")
    public String nome;

    @ColumnInfo(name = "morada")
    public String morada;

    @ColumnInfo(name = "contactoNumero")
    public String contactoNumero;

    @ColumnInfo(name = "contactoEmail")
    public String contactoEmail;

    @ColumnInfo(name = "website")
    public String website;

    public EmpresasEntity(String nome, String morada, String contactoNumero,
                          String contactoEmail, String website) {
        this.nome = nome;
        this.morada = morada;
        this.contactoNumero = contactoNumero;
        this.contactoEmail = contactoEmail;
        this.website = website;
    }
}
