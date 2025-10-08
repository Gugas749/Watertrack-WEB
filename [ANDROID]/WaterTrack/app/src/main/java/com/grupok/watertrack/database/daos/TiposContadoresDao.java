package com.grupok.watertrack.database.daos;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import com.grupok.watertrack.database.entities.TiposContadoresEntity;

import java.util.List;

@Dao
public interface TiposContadoresDao {

    @Insert
    void insert(TiposContadoresEntity tipoContador);

    @Insert
    void insertList(List<TiposContadoresEntity> tiposContadores);

    @Update
    void update(TiposContadoresEntity tipoContador);

    @Query("SELECT * FROM TIPOS_contadores")
    List<TiposContadoresEntity> getTiposContadores();

    @Query("DELETE FROM TIPOS_contadores")
    void clearAllEntries();
}
