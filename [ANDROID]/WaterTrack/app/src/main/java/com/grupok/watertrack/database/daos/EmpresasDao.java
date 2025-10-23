package com.grupok.watertrack.database.daos;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import com.grupok.watertrack.database.entities.EmpresasEntity;

import java.util.List;

@Dao
public interface EmpresasDao {

    @Insert
    void insert(EmpresasEntity empresa);

    @Insert
    void insertList(List<EmpresasEntity> empresas);

    @Update
    void update(EmpresasEntity empresa);

    @Query("SELECT * FROM Empresas")
    List<EmpresasEntity> getEmpresas();

    @Query("DELETE FROM Empresas")
    void clearAllEntries();
}
