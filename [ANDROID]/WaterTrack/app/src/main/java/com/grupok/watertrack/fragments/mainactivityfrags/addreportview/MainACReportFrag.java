package com.grupok.watertrack.fragments.mainactivityfrags.addreportview;

import android.annotation.SuppressLint;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.text.Editable;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.databinding.FragmentMainACReportBinding;

import java.util.ArrayList;
import java.util.List;

public class MainACReportFrag extends Fragment {

    private MainActivity parent;
    private FragmentMainACReportBinding binding;
    private MainACReportFrag THIS;
    private List<ContadorEntity> contadoresEntityList;
    private List<String> listString = new ArrayList<>();
    private Context context;
    private int contadorId = -1;
    private String contadorNome = "";
    private String contadorMorada = "";

    public MainACReportFrag() {
        // Required empty public constructor
    }

    public MainACReportFrag(MainActivity parent, List<ContadorEntity> contadoresEntityList) {
        this.parent = parent;
        this.contadoresEntityList = contadoresEntityList;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentMainACReportBinding.inflate(inflater, container, false);

        // 🔹 Receber argumentos (se existirem)
        if (getArguments() != null) {
            int id = getArguments().getInt("contadorId", -1);
            if (id == -1) {
                setArguments(null);
            }
        }

        // 🔹 Procurar contador correspondente
        if (contadoresEntityList != null && contadorId != -1) {
            for (ContadorEntity c : contadoresEntityList) {
                if (c.id == contadorId) {
                    contadorNome = c.nome;
                    contadorMorada = c.morada;
                    break;
                }
            }
        }

        if (parent != null && parent.currentUserInfo != null) {
            init();
        }

        return binding.getRoot();
    }

    private void init() {
        int cargo = parent.currentUserInfo.Cargo;

        fillProblem(listString);
        setupComboProblem();
        setupButtonSave();
        setupUserType(cargo);

        // 🔹 Só mostra todos os contadores se não veio de bundle
        if (contadorId == -1) {
//            mostrarTodosContadores();
            setupFiltroPorId(); // só técnico sem bundle pode filtrar
        }
    }

    private void fillProblem(List<String> list) {
        list.add("Fuga de água no contador");
        list.add("Leitura incorreta do consumo");
        list.add("Vidro do mostrador embaciado");
        list.add("Bloqueio do mecanismo interno");
        list.add("Contador avariado ou parado");
        list.add("Ligação solta ou danificada");
        list.add("Presença de ar nas tubagens");
        list.add("Infiltração de sujidade ou detritos");
        list.add("Congelamento do contador (em tempo frio)");
        list.add("Manipulação indevida do equipamento");
        list.add("Oxidação ou ferrugem nas ligações metálicas");
        list.add("Falha na comunicação com o sistema remoto");
        list.add("Bateria interna descarregada (em contadores eletrónicos)");
        list.add("Selo de segurança rompido");
        list.add("Instalação incorreta do contador");
        list.add("Outro");

        ArrayAdapter<String> adapter = new ArrayAdapter<>(
                requireContext(),
                android.R.layout.simple_dropdown_item_1line,
                list
        );

        binding.comboBoxProblemReportFragMainAc.setAdapter(adapter);

        binding.inputLayoutComboBoxProblemReportFragMainAc.setEndIconOnClickListener(
                v -> binding.comboBoxProblemReportFragMainAc.showDropDown());
        binding.comboBoxProblemReportFragMainAc.setOnClickListener(
                v -> binding.comboBoxProblemReportFragMainAc.showDropDown());
    }

    private void setupComboProblem() {
        binding.comboBoxProblemReportFragMainAc.setOnItemClickListener((adapterView, view, position, id) -> {
            String selected = listString.get(position);
            if (selected.equalsIgnoreCase("Outro")) {
                binding.inputLayoutTextInputOtherProblemReportFragMainAc.setVisibility(View.VISIBLE);
            } else {
                binding.inputLayoutTextInputOtherProblemReportFragMainAc.setVisibility(View.GONE);
            }
        });
    }

    private void setupButtonSave() {
        binding.butSaveReportFragMainAC.setOnClickListener(v -> {
            if (binding.inputLayoutTextInputOtherProblemReportFragMainAc.getVisibility() == View.VISIBLE) {
                String novoProblema = binding.editTextOtherProblemReportFragMainAc.getText().toString().trim();
                if (!novoProblema.isEmpty() && !listString.contains(novoProblema)) {
                    listString.add(listString.size() - 1, novoProblema); // adiciona antes do "Outro"
                    ((ArrayAdapter<String>) binding.comboBoxProblemReportFragMainAc.getAdapter()).notifyDataSetChanged();
                    binding.editTextOtherProblemReportFragMainAc.setText("");
                    binding.inputLayoutTextInputOtherProblemReportFragMainAc.setVisibility(View.GONE);
                }
            }
        });
    }

    // 🔹 Configurar tipo de utilizador
    private void setupUserType(int cargo) {
        if (cargo == 1) { // Técnico
            if (contadorId != -1) {
                String texto = "" + contadorId;
                if (!contadorMorada.isEmpty()) {
                    texto += " — " + contadorMorada;
                }
                binding.editTextMeterReportFragMainAc.setText(texto);
                binding.editTextMeterReportFragMainAc.setEnabled(false); // 🔒 bloqueado
            } else {
                binding.editTextMeterReportFragMainAc.setText("");
                binding.editTextMeterReportFragMainAc.setHint("Digite o ID do contador");
                binding.editTextMeterReportFragMainAc.setEnabled(true); // ✏️ desbloqueado
            }

            Toast.makeText(requireContext(), "Morador", Toast.LENGTH_SHORT).show();

        } else if (cargo == 0) { // Morador
            if (contadorId != -1) {
                String texto = "" + contadorId;
                if (!contadorNome.isEmpty()) {
                    texto += " — " + contadorNome;
                }
                binding.editTextMeterReportFragMainAc.setText(texto);
            }

            binding.editTextMeterReportFragMainAc.setEnabled(false); // 🔒 bloqueado
            Toast.makeText(requireContext(), "Tecnico", Toast.LENGTH_SHORT).show();
        }
    }

    private void mostrarTodosContadores() {
        if (contadoresEntityList == null || contadoresEntityList.isEmpty()) return;

        StringBuilder sb = new StringBuilder();
        for (ContadorEntity c : contadoresEntityList) {
            sb.append("ID: ").append(c.id)
                    .append(" — Nome: ").append(c.nome)
                    .append(" — Morada: ").append(c.morada)
                    .append("\n");
        }
        binding.editTextMeterReportFragMainAc.setText(sb.toString());
    }

    // 🔹 Filtro por ID (só usado por técnico sem bundle)
    private void setupFiltroPorId() {
        TextWatcher watcher = new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {}

            @Override
            public void afterTextChanged(Editable s) {
                String input = s.toString().trim();
                if (input.isEmpty()) return;

                try {
                    int idPesquisado = Integer.parseInt(input);
                    ContadorEntity c = null;
                    for (ContadorEntity contador : contadoresEntityList) {
                        if (contador.id == idPesquisado) {
                            c = contador;
                            break;
                        }
                    }

                    binding.editTextMeterReportFragMainAc.removeTextChangedListener(this);

                    if (c != null) {
                        String texto = "ID: " + c.id + " — Nome: " + c.nome + " — Morada: " + c.morada;
                        binding.editTextMeterReportFragMainAc.setText(texto);
                    } else {
                        binding.editTextMeterReportFragMainAc.setText("Contador não encontrado");
                    }

                    binding.editTextMeterReportFragMainAc.addTextChangedListener(this);

                } catch (NumberFormatException e) {
                    binding.editTextMeterReportFragMainAc.removeTextChangedListener(this);
                    binding.editTextMeterReportFragMainAc.setText("ID inválido");
                    binding.editTextMeterReportFragMainAc.setText("");
                    binding.editTextMeterReportFragMainAc.addTextChangedListener(this);
                }
            }
        };

        binding.editTextMeterReportFragMainAc.addTextChangedListener(watcher);
    }
}
