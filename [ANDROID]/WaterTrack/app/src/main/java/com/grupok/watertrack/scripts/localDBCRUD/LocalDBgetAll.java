package com.grupok.watertrack.scripts.localDBCRUD;

import com.grupok.watertrack.database.entities.AvariasContadoresEntity;
import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.database.entities.EmpresasEntity;
import com.grupok.watertrack.database.entities.LogsContadoresEntity;
import com.grupok.watertrack.database.entities.TecnicoInfoEntity;
import com.grupok.watertrack.database.entities.TiposContadoresEntity;
import com.grupok.watertrack.database.entities.UserInfosEntity;

import java.util.List;

public class LocalDBgetAll {
    public List<LogsContadoresEntity> logsContEntityList;
    public List<ContadorEntity> contadoresEntityList;
    public List<AvariasContadoresEntity> avariasContadoresEntityList;
    public List<EmpresasEntity> empresasEntityList;
    public List<TecnicoInfoEntity> tecnicoInfoEntityList;
    public List<TiposContadoresEntity> tiposContadoresEntityList;
    public UserInfosEntity userInfo;

    public LocalDBgetAll(List<LogsContadoresEntity> logsContEntityList, List<ContadorEntity> contadoresEntityList, List<AvariasContadoresEntity> avariasContadoresEntityList, List<EmpresasEntity> empresasEntityList, List<TecnicoInfoEntity> tecnicoInfoEntityList, List<TiposContadoresEntity> tiposContadoresEntityList, UserInfosEntity userInfo) {
        this.logsContEntityList = logsContEntityList;
        this.contadoresEntityList = contadoresEntityList;
        this.avariasContadoresEntityList = avariasContadoresEntityList;
        this.empresasEntityList = empresasEntityList;
        this.tecnicoInfoEntityList = tecnicoInfoEntityList;
        this.tiposContadoresEntityList = tiposContadoresEntityList;
        this.userInfo = userInfo;
    }
}
